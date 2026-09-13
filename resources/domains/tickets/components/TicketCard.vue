<script setup lang="ts"></script>

<template>

    <div class="ticket-card">
        <div class="card-header">
            <div class="ticket-number">
                <span>TICKET</span>
                <strong>#001</strong>
            </div>
            <button
                class="ticket-menu"
                type="button"
                aria-label="Actions for ticket 001"
            >
                <span aria-hidden="true">•••</span>
            </button>
        </div>
        <div class="card-content">
                <h4>
                    Title of this Ticket but what if its really long
                </h4>
                <div class="ticket-update-section content-border pb-1">
                    <span class="ticket-status">
                        <svg class="status-check" viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="12" fill="currentColor" />
                            <path
                                d="m6.5 12 3.5 3.5 7.5-7.5"
                                fill="none"
                                stroke="white"
                                stroke-width="2.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        Closed
                    </span>
                    <span class="ticket-updated">
                        <svg class="clock-icon" viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 6v6h5" />
                        </svg>
                        Updated: 1 day ago
                    </span>
                </div>
            
            <div class="ticket-category mt-1 ">
                <svg class="category-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 7V5a1 1 0 0 1 1-1h5l2 3h9a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7Z" />
                </svg>

                <div class="category-text">
                    <span>Category</span>
                    <strong>General</strong>
                </div>
            </div>
        </div>
         <div class="card-footer">
            <div class="users-row">
                <span
                    class="users-icon person-icon"
                    aria-hidden="true"
                >
                    <svg class="users-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="7" r="4" />
                        <path d="M4 21v-2a8 8 0 0 1 16 0v2" />
                    </svg>
                </span>

                <div class="users-text">
                    <span class="users-label">Created by</span>
                    <span class="users-name">Dannie Harvey</span>
                </div>
            </div>

            <div class="users-row">
                <span
                    class="users-icon person-icon"
                    aria-hidden="true"
                >
                    <svg class="users-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="9" cy="7" r="4" />
                        <path d="M2 21v-2a7 7 0 0 1 11-5.7" />
                        <path d="m15 18 2 2 5-6" />
                    </svg>
                </span>

                <div class="users-text">
                    <span class="users-label">Assigned to</span>
                    <span class="users-name">Eliza Graves Long</span>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>
    .ticket-card {
        --card-border: #b8c4fa;
    
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
        border: 1px solid var(--card-border);
        border-radius: 1.25rem;
        background: var(--bg-color-card);
        color: var(--font-color-medium-dark);
    }

    
    .card-header {
        position: relative;
        height: 2.9rem;
        border-radius: calc(1.25rem - 1px) calc(1.25rem - 1px) 0 0;
        background: linear-gradient(
            110deg,
            #c2cef5,
            #cbbff3 55%,
            #bdccf4
        );
    }

    .ticket-number {
        position: absolute;
        top: 1.12rem;
        left: 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 0.13rem;
        align-items: center;
        min-width: 5.5rem;
        box-sizing: border-box;
        padding: 0.62rem 0.75rem;
        background: var(--bg-color-card);
        color: var(--font-color-medium)
    }

    .ticket-number span {
        font-size: 0.75rem;
        font-weight: 600;
    }

    .ticket-number strong {
        font-size: var(--text-label);
    }

    .ticket-menu {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        display: grid;
        place-items: center;
        width: 2.75rem;
        height: 2.75rem;
        padding: 0;
        border: 1.5px dashed var(--border-color-darker);
        border-radius: 50%;
        background: var(--bg-color-card);
        color: var(--font-color-medium);
        cursor: pointer;
    }

    .ticket-menu:focus-visible {
        outline: 2px solid #4263eb;
        outline-offset: 3px;
    }

    .card-content {
        display: grid;
        gap: 0.8rem;
        padding: 1.5rem;
        padding-top: 1.8rem;
    }

    .ticket-update-section {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.75rem 1rem;
    }

    .ticket-status {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.9rem;
        border-radius: 0.5rem;
        background: #dae8db;
        color: #3f6f45;
        font-size: var(--text-caption);
        font-weight: 700;
        line-height: 1.2;
    }

    .status-check {
        display: block;
        width: 1.1rem;
        height: 1.1rem;
        flex-shrink: 0;
        color: #66a36b;
    }

    .ticket-updated {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding-left: 1rem;
        border-left: 1px solid var(--border-color-darker);
        color: var(--font-color-medium-dark);
        font-size: var(--text-label);
        line-height: 1.5;
    }

    .users-row {
        display: flex;
        align-items: center;
        gap: 0.9rem;
    }

    .users-text {
        display: flex;
        flex-direction: column;
        gap: 0.13rem;
        min-width: 0;
    }

    .users-label {
        color: var(--font-color-medium-dark);
        font-size: var(--text-caption);
        line-height: 1.3;
    }

    .users-name {
        font-size: var(--text-label);
        color: var(--font-color-medium-dark);
        font-weight: 600;
        line-height: 1.25;
        overflow-wrap: anywhere;
    }

    .users-icon {
        width: 1.55rem;
        height: 1.55rem;
        flex-shrink: 0;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.7;
        stroke-linecap: round;
        stroke-linejoin: round;
        color: var(--color-grey);
    }

    .clock-icon,
    .category-icon {
        flex-shrink: 0;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
        color: var(--font-color-medium);
    }

    .clock-icon {
        width: 1.4rem;
        height: 1.4rem;
    }

    .ticket-category {
        display: flex;
        align-items: center;
        gap: 0.95rem;
    }

    .category-icon {
        width: 1.9rem;
        height: 1.9rem;
    }

    .category-text {
        display: flex;
        flex-direction: column;
        gap: 0.13rem;
    }

    .category-text span {
        color: var(--font-color-medium);
        font-size: var(--text-caption);
    }

    .category-text strong {
        color: var(--font-color-medium-dark);
        font-weight: 700;
        font-size: var(--text-label);
    }

    .card-footer {
        display: flex;
        flex-direction: column;
        gap: 1.75rem;
        padding: 1.2rem 1.5rem;
        border-top: 1px dashed var(--border-color-darker);
        border-radius: 0 0 calc(1.25rem - 1px) calc(1.25rem - 1px);
        background: var(--bg-color-card-medium);
    }

    .content-border {
        border-bottom: 1px dashed var(--card-border);
    }

    @media (min-width: 400px) {
        .card-footer {
            flex-direction: row;
            align-items: flex-start;
        }

        .users-row {
            flex: 1;
        }
    }

    .card-content > h4 {
        margin: 0;
        overflow-wrap: anywhere;
    }

    .users-row {
        min-width: 0;
    }

    /* Medium screens */
    @media (min-width: 768px) {
        .card-content {
            grid-template-columns: minmax(0, 2fr) minmax(0, 1fr);
            grid-template-areas:
                "title title"
                "updates category";
            align-items: center;
            gap: var(--space-4);
        }

        .card-content > h4 {
            grid-area: title;
        }

        .ticket-update-section {
            grid-area: updates;
            min-width: 0;
            border-bottom: 0;
            padding-bottom: 0;
        }

        .ticket-category {
            grid-area: category;
            min-width: 0;
            margin-top: 0;
        }

        .category-text {
            min-width: 0;
            overflow-wrap: anywhere;
        }

        .card-footer {
            gap: var(--space-4);
        }
    }
</style>