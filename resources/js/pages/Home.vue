<script setup lang="ts">

</script>


<template>
        <div class="grid-container-fluid">
            <div class="grid-container">
                <div class="row bg-dark m-2">
                    <div class="col-5 d-flex flex-column items-center justify-center p-5">
                        <h2 class="title">
                            Hello there
                        </h2>
                        <p class="text">
                            Login to do some work
                        </p>
                    </div>
                    <div class="col-7 bg-login d-flex flex-column items-center justify-center">
                        <h1 class="light">
                            Login
                        </h1>
                    </div> 
                </div>
                
            </div>
        </div>
</template>

<style scoped>

    .bg-dark {
        background-color: #092b59;
        border: 1px solid var(--border-color-blue);
    }

    .bg-login {
        background-color: #0c234e;
        border-left: 1px solid #12316b;
    }

    h2.title {
        color: var(--color-yellow);
    }

    p.text {
        font-size: var(--font-size-md);
        color: var(--font-color-light);
    }

</style>