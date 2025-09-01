<script setup>

import goTo from '@/goTo.js'
import { usePage } from '@inertiajs/vue3'
import { computed } from "vue"

const page = usePage();
const user = computed(() => page.props.auth?.user ?? null)
const role = computed(() => user.value?.role?.name ?? null)

</script>

<template>
    <aside class="column menu mr-3" style="min-height: 100vh;">
        <div v-if="role == 'admin'">
            <p class="menu-label has-text-white">
                Geral
            </p>
            <ul class="menu-list">
                <li class="mb-2"><a @click.prevent="goTo('dashboard')"
                        :class="{ 'is-active': route().current('dashboard') }"><i class="fas fa-tachometer-alt"></i>
                        Dashboard</a></li>
                <li class="mb-2"><a @click.prevent="goTo('funcionarios.index')"
                        :class="{ 'is-active': route().current('funcionarios.*') }"><i class="fas fa-users"></i>
                        Funcionários</a></li>
                <li class="mb-2"><a><i class="fas fa-chart-line"></i> Relatórios</a></li>
            </ul>
        </div>

        <p class="menu-label has-text-white mt-5">
            Configurações
        </p>
        <ul class="menu-list">
            <li class="mb-2"><a><i class="fas fa-user-cog"></i> Perfil</a></li>
            <li class="mb-2"><a @click.prevent="goTo('logout', 'POST')" class="has-text-danger"><i
                        class="fas fa-sign-out-alt"></i> Sair</a></li>
        </ul>
    </aside>
</template>