@servers(['dev' => 'runcloud@5.39.88.195', 'local' => '127.0.0.1'])

@setup
    $releases_dir = '/home/runcloud/webapps/reviews';
    $new_release_dir = $releases_dir . '/' . $slug;
@endsetup

@story('deploy')
    create_release_dir
    transfert_files
    update_symlinks
@endstory

@task('create_release_dir', ['on' => 'dev'])
    echo 'Creating new review directory'
    rm -rf {{ $new_release_dir }}
    mkdir {{ $new_release_dir }}
@endtask

@task('transfert_files', ['on' => 'local'])
    echo 'Transferring build files'
    scp -P22 ./artefacts/radiophonix.tar.bz2 "runcloud@5.39.88.195:{{ $new_release_dir }}"
@endtask

@task('update_symlinks', ['on' => 'dev'])
    tar jxf {{ $new_release_dir }}/radiophonix.tar.bz2 -C {{ $new_release_dir }}
    rm {{ $new_release_dir }}/radiophonix.tar.bz2

    cp {{ $new_release_dir }}/.env.review {{ $new_release_dir }}/.env
    touch {{ $new_release_dir }}/storage/database.sqlite

    echo "APP_URL=http://{{ $slug }}.radiophonix.org" >> {{ $new_release_dir }}/.env
    cat {{ $releases_dir }}/.env.review >> {{ $new_release_dir }}/.env

    echo 'Generating Laravel cache'
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan key:generate --force --no-interaction
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan package:discover
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan route:cache
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan config:cache
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan storage:link

    echo 'Running migrations'
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan migrate --force --no-interaction
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan alpha:seed

    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan scout:mysql-index

    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan badge:sync
@endtask
