<script setup>

import DashboardLayout from '../Layouts/DashboardLayout.vue'
import { router, useForm, usePage } from '@inertiajs/vue3'
import { computed, ref } from "vue"

const props = defineProps({
   pontos: { type: Object }
});

const page = usePage();
const user = computed(() => page.props.auth?.user ?? null)
const role = computed(() => user.value?.role?.name ?? null)

const loading = ref(false)
const form = useForm({})

const logout = () => {
   router.post(route('logout'));
}

const registrarPonto = () => {
   loading.value = true;
   form.post(route('pontos.store'), {
      preserveScroll: true,
      onSuccess: () => {
         loading.value = false;
      },
      onError: (errors) => {
         loading.value = false;
         console.log(errors);
      }
   })
}

</script>

<template>
   <DashboardLayout>
      <div class="box">
         <div v-if="page.props.flash.success" class="notification is-success">
            {{ page.props.flash.success }}
         </div>

         <div v-if="page.props.flash.error" class="notification is-danger">
            {{ page.props.flash.error }}
         </div>
         <h1 class="title mb-3">Bem-vindo, {{ user.name }}!</h1>
         <div v-if="role == 'admin'">
            <p class="subtitle">Essa é a página inicial do Ticto Ponto.</p>
            <p class="subtitle">Utilize <a><i class="fas fa-users"></i> Funcionários</a> para listar, cadastrar, editar
               e deletar seus funcionários.</p>
            <p class="subtitle">Utilize <a><i class="fas fa-chart-line"></i> Relatórios</a> para obter relatórios dos
               pontos eletrônicos dos funcionários.</p>
            <p class="subtitle">Utilize <a><i class="fas fa-user-cog"></i> Perfil</a> para editar seus dados cadastrais.
            </p>
            <p class="subtitle">Utilize <a @click.prevent="logout()" class="has-text-danger"><i
                     class="fas fa-sign-out-alt"></i> Sair</a> para efetuar logout.</p>
         </div>
         <div v-else-if="role == 'funcionario'">
            <p class="mb-4">Clique no botão abaixo para registrar o seu ponto eletrônico.</p>
            <button @click="registrarPonto()" class="button is-success has-text-white" :disabled="loading">
               <i class="fas fa-clock mr-3"></i>
               {{ loading ? 'Registrando...' : 'Registrar ponto eletrônico' }}
            </button>

            <div v-if="pontos.data" class="mt-5">
               <h2 class="title is-4">Ultimos pontos registrados</h2>
               <ul>
                  <li v-for="ponto in pontos.data" :key="ponto.id">
                     <strong>{{ ponto.nome }} ({{ ponto.cpf }})</strong> -
                     {{ ponto.data }} às {{ ponto.hora }}
                  </li>
               </ul>
            </div>
         </div>
         <div v-else>
            Bem-vindo ao Ticto Ponto!
         </div>
      </div>
   </DashboardLayout>
</template>