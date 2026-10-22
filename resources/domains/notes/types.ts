  import type { User } from "../users/types"
 
 export interface Note {
        id: number
        ticket_id: number
        user_id: number | null;
        user: Pick<User, "id" | "first_name" | "last_name" | "name"> | null;
        content: string
        created_at: string
        updated_at: string
    }

    export interface CreateNote {
        content: string;
    }

    export type UpdateNote = CreateNote;