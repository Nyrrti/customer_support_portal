 import type { User } from "../users/types"
 
 export interface Reply {
        id: number
        ticket_id: number
        user_id: number
        user: Pick<User, "id" | "first_name" | "last_name" | "name">;
        content: string
        category_id: number;
        created_at: string
        updated_at: string
    }

    export type CreateReply = Reply;
    export type UpdateReply = Reply;