<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  registros: {
    type: Array,
    required: true,
  },
});

const page = usePage();

const form = useForm({
    data_inicial: '',
    data_final: ''
})

const errorMessage = ref(null)

const submit = () => {
    form.post(route('pontos.relatorio'), {
        onError: () => {
            errorMessage.value = form.errors

            console.log(form.errors)
        }
    });
}

</script>

<template>
    <DashboardLayout>
        <div class="box">
            <div v-if="errorMessage" class="notification is-danger">
                <ul>
                    <li v-for="error in errorMessage">
                        {{ error }}
                    </li>
                </ul>
            </div>
            <h1 class="title">Relatório de pontos eletrônicos</h1>
            <p class="mb-5">Deixe as datas em branco para pegar o relatório do dia atual.</p>
            <form action="" @submit.prevent="submit()">
                <div class="field is-grouped is-flex is-align-items-center">
                    <!-- Data inicial -->
                    <strong>Do dia:</strong>
                    <div class="control">
                        <input v-model="form.data_inicial" class="input" type="date" id="data_inicial"
                            name="data_inicial" />
                    </div>


                    <!-- Data final -->
                    <strong>Até o dia:</strong>
                    <div class="control">
                        <input v-model="form.data_final" class="input" type="date" id="data_final" name="data_final" />
                    </div>


                    <!-- Submit -->
                    <div class="control">
                        <button type="submit" class="button is-link">Aplicar</button>
                    </div>
                </div>

                <table v-if="registros" class="table is-fullwidth is-striped is-hoverable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Funcionário</th>
                            <th>Cargo</th>
                            <th>Idade</th>
                            <th>Gestor</th>
                            <th>Data/Hora Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="registro in registros" :key="registro.registro_id">
                            <td>{{ registro.registro_id }}</td>
                            <td>{{ registro.funcionario_nome }}</td>
                            <td>{{ registro.cargo }}</td>
                            <td>{{ registro.idade }}</td>
                            <td>{{ registro.gestor_nome }}</td>
                            <td>{{ new Date(registro.data_hora_registro).toLocaleString() }}</td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </DashboardLayout>
</template>