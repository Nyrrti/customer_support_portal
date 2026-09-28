    import type { Category } from "../categories/types";
    import type { User } from "../auth/types"

    export interface Ticket {
        id: number
        title: string
        description: string
        status: string
        created_at: string
        updated_at: string
        created_by_id: number
        assigned_to_id: number | null
        category_id: number

        created_by: User
        assigned_to: User | null
        category: Category
    }

    export interface CreateTicket {
        title: string
        description: string
        category_id: number | null;
    }

    export interface UpdateTicket {
        title: string
        description?: string
        status: string
        assigned_to_id?: number | null
        category_id?: number
    }
