    export interface Category {
        id: number
        title: string
    }

    export interface CreateCategory {
        title: string
    }

    /** Editing currently uses the same fields as creating. */
    export type UpdateCategory = CreateCategory;