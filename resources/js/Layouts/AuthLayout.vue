<script setup>
    import Header from '../Components/Header.vue';
</script>

<template>
    <section class="section tictoponto">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-5">
                    <Header></Header>
                    <slot></slot>
                </div>
            </div>
        </div>
    </section>
</template>
