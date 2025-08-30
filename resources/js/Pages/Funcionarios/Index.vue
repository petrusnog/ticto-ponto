<script setup>

import DashboardLayout from '../../Layouts/DashboardLayout.vue'
import { Link, router } from '@inertiajs/vue3'
import dayjs from 'dayjs'

const props = defineProps({
    funcionarios: { type: Object }
});

const logout = () => {
    router.post(route('logout'));
}

const formatDate = (date) => {
  return dayjs(date).format('DD/MM/YYYY');
};

</script>

<template>
    <DashboardLayout>
        <div class="box">
            <div class="is-flex is-justify-content-space-between is-align-items-center">
                <h3 class="title is-4">Funcionários</h3>
                <button class="button is-success"><i class="fas fa-users mr-2"></i> Criar novo</button>
            </div>

            <table class="table is-striped is-fullwidth is-hoverable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Administrador</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="func in funcionarios.data" :key="func.id">
                        <td>{{ func.id }}</td>
                        <td>{{ func.name }}</td>
                        <td>{{ func.email }}</td>
                        <td>{{ func.admin?.name }}</td>
                        <td>{{ formatDate(func.created_at) }}</td>
                        <td>
                            <div class="buttons">
                                <a href="#" class="button is-small is-info">Editar</a>
                                <a href="#" class="button is-small is-danger">Excluir</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="is-flex is-justify-content-center gap-2 mt-4">
                <template v-for="link in funcionarios.links" :key="link.url">
                <Link v-if="link.url" :href="link.url" v-html="link.label"
                    class="pagination-item button is-info px-3 py-1 mr-4 border rounded"
                    :class="{ 'is-dark font-bold': link.active }" />
                <span v-else v-html="link.label" class="button px-3 py-1 mr-4" disabled></span>
                </template>
            </div>
        </div>
    </DashboardLayout>
</template>