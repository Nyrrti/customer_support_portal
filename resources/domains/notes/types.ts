  import type { User } from "../users/types"
 
 export interface Note {
        id: number
        ticket_id: number
        user_id: number
        user: Pick<User, "id" | "first_name" | "last_name" | "name">;
        content: string
        created_at: string
        updated_at: string
    }

    export type CreateNote = Note;
    export type UpdateNote = Note;