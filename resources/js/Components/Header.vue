<script setup>
    import logoImage from '/resources/images/logo.svg'
</script>

<template>
    <div class="is-flex is-justify-content-space-between is-align-items-center mb-5">
        <img :src="logoImage" class="ticto-logo" alt="Ticto Logotipo">
        <p class="has-text-weight-light has-text-white">Gestão de Ponto Eletrônico</p>
    </div>
</template>

<style>
.ticto-logo {
    width: 150px;
}
</style>