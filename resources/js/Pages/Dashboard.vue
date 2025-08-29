<script setup>

import DashboardLayout from '../Layouts/DashboardLayout.vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
   user: {type: Object}
});

const logout = () => {
    router.post(route('logout'));
}

</script>

<template>
   <DashboardLayout>
      <div class="box">
         <h1 class="title mb-3">Bem-vindo, {{ user.name }}!</h1>
         <p class="subtitle">Essa é a página inicial do Ticto Ponto.</p>
         <p class="subtitle">Utilize <a><i class="fas fa-users"></i> Funcionários</a> para listar, cadastrar, editar e deletar seus funcionários.</p>
         <p class="subtitle">Utilize <a><i class="fas fa-chart-line"></i> Relatórios</a> para obter relatórios dos pontos eletrônicos dos funcionários.</p>
         <p class="subtitle">Utilize <a><i class="fas fa-user-cog"></i> Perfil</a> para editar seus dados cadastrais.</p>
         <p class="subtitle">Utilize <a @click.prevent="logout()" class="has-text-danger"><i class="fas fa-sign-out-alt"></i> Sair</a> para efetuar logout.</p>
      </div>
   </DashboardLayout>
</template>