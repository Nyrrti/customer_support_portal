<template>
    <div class="sidebar-content">
        <div class="mt-4">
            <h1 class="light">
                Welcome to <span class="yellow">TicketyTicker</span>
            </h1>
            <p class="sidebar-intro light">
                Submit, track and resolve support tickets quickly and efficiently.
            </p>
        </div>
        <div class="sidebar-features">
            <div class="feature">
                <div class="feature-icon">
                    +
                </div>
                <div>
                    <h4 class="light">
                        Track Status
                    </h4>
                    <p class="feature-text">
                        Submit a new request with all the details we need.
                    </p>
                </div>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    ✓
                </div>
                <div>
                    <h4 class="light">
                        Track Status
                    </h4>
                    <p class="feature-text">
                        Monitor the progress of your ticket.
                    </p>
                </div>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    ≡
                </div>

                <div>
                    <h4 class="light">View Responses</h4>
                    <p class="feature-text">
                        Read replies and updates from our support team.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .sidebar-content {
        --sidebar-padding: 3rem;
        --sidebar-gap: 4.5rem;
        --feature-gap: 1rem;
        --feature-icon-size: 3rem;

        min-height: 100%;
        padding: var(--sidebar-padding);
        display: flex;
        flex-direction: column;
        gap: var(--sidebar-gap);
        position: relative;
        overflow: hidden;
        background-color: var(--bg-color-sidebar);
    }

    .sidebar-content > * {
        position: relative;
        z-index: 1;
    }

    .sidebar-content::before {
        content: "";
        position: absolute;

        width: 110rem;
        height: 60rem;

        top: -25rem;
        left: -60rem;

        border-radius: 50%;

        background: radial-gradient(
            ellipse,
            color-mix(in srgb, var(--bg-color-sidebar) 65%, var(--sidebar-glow)) 0%,
            color-mix(in srgb, var(--bg-color-sidebar) 75%, var(--sidebar-glow-purple)) 38%,
            transparent 65%
        );

            pointer-events: none;
            z-index: 0;
        }

    .sidebar-intro {
        max-width: 24rem;
        margin-top: 1rem;
    }

    .sidebar-features {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .feature {
        display: flex;
        align-items: flex-start;
        gap: var(--feature-gap);
        min-height: 5rem;
    }

    .feature-icon {
        width: var(--feature-icon-size);
        height: var(--feature-icon-size);
        flex-shrink: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        background-color: var(--color-blue);
        color: var(--font-color-light);
        font-size: var(--font-size-lg);
        font-weight: 600;
    }

    .feature-text {
        max-width: 18rem;
        color: var(--font-color-medium-light);
    }

</style>