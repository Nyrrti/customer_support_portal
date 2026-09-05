    import type { Category } from "../categories/types";

    export interface Ticket {
        id: number
        subject: string
        description: string
        status: string
        updated_at: string
        created_by_id: number
        assigned_to_id: number | null
        category_id: number

        created_by: User
        assigned_to: User | null
        category: Category
    }

    export interface CreateTicket {
        subject: string
        description: string
        category_id: number | null;
    }

    export interface UpdateTicket {
        subject?: string
        description?: string
        status?: string
        assigned_to_id?: number | null
        category_id?: number
    }

    export interface User {
        id: number
        name: string
    }