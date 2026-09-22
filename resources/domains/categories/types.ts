    export interface Category {
        id: number
        title: string
        category_id: number;
    }

    export interface CreateCategory {
        title: string
        category_id: number | null;
    }

    export interface UpdateCategory {
        title: string
        category_id?: number
    }