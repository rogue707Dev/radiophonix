export interface Saga {
    id: string;
    slug: string;
    name: string;
    synopsis: string;
    create_date: string;

    licence: {
        name: string;
        url: string;
    };

    links: {
        netowiki: string;
        site: string;
        rss: string;
        facebook: string;
        twitter: string;
    };

    finished: boolean;

    stats: {
        likes: number;
        albums: number;
        tracks: number;
    }

    created_at: string;
    updated_at: string;
}
