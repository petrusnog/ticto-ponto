<script setup>

import { router } from '@inertiajs/vue3'

const goTo = (routeName, method = 'GET') => {
    if (method == 'POST') {
        router.post(route(routeName));
    } else {
        router.get(route(routeName));
    }
}

</script>

<template>
    <aside class="column menu mr-3" style="min-height: 100vh;">
        <p class="menu-label has-text-white">
            Geral
        </p>
        <ul class="menu-list">
            <li class="mb-2"><a @click.prevent="goTo('dashboard')" class="is-active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="mb-2"><a @click.prevent="goTo('funcionarios.index')"><i class="fas fa-users"></i> Funcionários</a></li>
            <li class="mb-2"><a><i class="fas fa-chart-line"></i> Relatórios</a></li>
        </ul>

        <p class="menu-label has-text-white mt-5">
            Configurações
        </p>
        <ul class="menu-list">
            <li class="mb-2"><a><i class="fas fa-user-cog"></i> Perfil</a></li>
            <li class="mb-2"><a @click.prevent="goTo('logout', 'POST')" class="has-text-danger"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
        </ul>
    </aside>
</template>