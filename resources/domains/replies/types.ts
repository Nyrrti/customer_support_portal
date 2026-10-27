 import type { User } from "../users/types"
 
 export interface Reply {
        id: number;
        ticket_id: number;
        user_id: number | null;
        user: Pick<User, "id" | "first_name" | "last_name" | "name"> | null;
        title: string;
        content: string;
        created_at: string;
        updated_at: string;
    }

    export interface CreateReply {
        title: string;
        content: string;
    }
    export type UpdateReply = CreateReply;