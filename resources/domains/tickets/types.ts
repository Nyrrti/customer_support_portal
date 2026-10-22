    import type { Category } from "../categories/types";
    import type { User } from "../users/types";
    import type { Note } from "../notes/types";
    import type { Reply } from "../replies/types";

    /**
     * Status values accepted by the ticket API.
     */
    export type TicketStatus = "pending" | "open" | "closed";
    export interface Ticket {
        id: number
        title: string
        description: string
        status: TicketStatus;
        /** Whether the current user may change this ticket's status. */
        can_change_status: boolean;
        created_at: string
        updated_at: string
        created_by_id: number
        assigned_to_id: number | null
        category_id: number

        created_by: User
        assigned_to: User | null
        category: Category
        notes: Note[];
        replies: Reply[];
    }

    export interface CreateTicket {
        title: string;
        description: string;
        category_id: number | null;
    }

    export type UpdateTicket = CreateTicket;