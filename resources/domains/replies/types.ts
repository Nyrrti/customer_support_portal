 export interface Reply {
        id: number
        ticket_id: number
        user_id: number
        content: string
        category_id: number;
        created_at: string
        updated_at: string
    }

    export type CreateReply = Reply;
    export type UpdateReply = Reply;