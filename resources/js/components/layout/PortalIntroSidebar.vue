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
        background-color: var(--bg-color-sidebar);
        position: relative;
        overflow: hidden;
        background:
        radial-gradient(
            ellipse 220% 80% at -10% -10% in oklab,
            rgba(37, 80, 146, 1) 12%,
            rgba(49, 66, 148, 0.95) 26%,
            rgba(66, 50, 144, 0.85) 42%,
            rgba(66, 50, 144, 0.35) 60%,
            rgba(66, 50, 144, 0) 76%
        ),

        radial-gradient(
            ellipse 190% 45% at 115% 108% in oklab,
            rgba(3, 135, 145, 0.48) 0%,
            rgba(4, 117, 143, 0.4) 20%,
            rgba(12, 96, 140, 0.35) 40%,
            rgba(37, 80, 146, 0.2) 58%,
            rgba(37, 80, 146, 0) 76%
        ),

        var(--bg-color-sidebar);
    }

    .sidebar-content::after {
        content: "";
        position: absolute;
        inset: -15%;
        background-image: url(
            "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='80' viewBox='0 0 160 80'%3E%3Cpath d='M-10 20 C20 2 50 38 80 20 S140 2 170 20' fill='none' stroke='white' stroke-opacity='.6' stroke-width='1' stroke-linecap='round' stroke-dasharray='2 7'/%3E%3Cpath d='M-10 62 C20 44 50 80 80 62 S140 44 170 62' fill='none' stroke='white' stroke-opacity='.35' stroke-width='1' stroke-linecap='round' stroke-dasharray='2 8'/%3E%3C/svg%3E"
        );

        background-size: 19rem 12rem;
        transform: rotate(8deg);
        transform-origin: center;
        opacity: 0.1;
        pointer-events: none;
        z-index: 0;
    }

    .sidebar-content > * {
        position: relative;
        z-index: 1;
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