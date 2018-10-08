@servers(['dev' => 'runcloud@5.39.88.195', 'local' => '127.0.0.1'])

@setup
    // Dossier racine
    $app_dir = '/home/runcloud/webapps/staging';

    // Dossier contenant les releases
    $releases_dir = '/home/runcloud/webapps/staging/releases';

    // Dossier contenant les dossiers/fichiers partagés
    $shared_dir = '/home/runcloud/webapps/staging/shared';

    // Chaque release est dans un dossier nommé selon la date et l'heure
    $release = date('Y-m-d-H-i-s');

    // Dossier de la nouvelle release
    $new_release_dir = $releases_dir . '/' . $release;
@endsetup

@story('deploy')
    create_release_dir
    transfert_files
    update_symlinks
    cleanup
@endstory

@task('create_release_dir', ['on' => 'dev'])
    echo 'Creating new release directory'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    mkdir {{ $new_release_dir }}
@endtask

@task('transfert_files', ['on' => 'local'])
    echo 'Transferring build files'
    scp -P22 ./artefacts/radiophonix.tar.bz2 "runcloud@5.39.88.195:{{ $new_release_dir }}"
@endtask

@task('update_symlinks', ['on' => 'dev'])
    tar jxf {{ $new_release_dir }}/radiophonix.tar.bz2 -C {{ $new_release_dir }}
    rm {{ $new_release_dir }}/radiophonix.tar.bz2

    echo 'Linking storage directory'
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $shared_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    ln -nfs {{ $shared_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current

    echo 'Generating Laravel cache'
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan package:discover
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan route:cache
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan config:cache
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan storage:link

    echo 'Running migrations'
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan migrate:fresh --force --no-interaction
    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan alpha:seed

    /RunCloud/Packages/php71rc/bin/php {{ $new_release_dir }}/artisan scout:mysql-index
@endtask

@task('cleanup', ['on' => 'dev'])
    echo 'Removing old releases'
    rm -rf `ls -t {{ $releases_dir }} | tail -n +4`
@endtask
