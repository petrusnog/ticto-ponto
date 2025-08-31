<script setup lang="ts">

import { ref } from 'vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';

const form = useForm({
    name: '',
    email: '',
    cpf: '',
    password: '',
    cargo: '',
    data_nascimento: '',
    cep: '',
    endereco: '',

})

const errorMessage = ref(null)
const errorCepMessage = ref(null)
const numero = ref('')


const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
        onError: () => {
            errorMessage.value = form.errors.email
        }
    });
}

const buscarCep = () => {
    // Limpando mensagem de erro.
    errorCepMessage.value = null

    const url = `/api/buscar-cep/${form.cep}`

    axios.get(url)
        .then(response => {
            console.log();

            form.endereco = `${response.data.logradouro}, ${numero.value}, ${response.data.bairro} - ${response.data.localidade}/${response.data.uf}`
        }).catch(error => {
            errorCepMessage.value = error.response.data.error
        });
}

</script>

<template>
    <DashboardLayout>
        <div class="box">
            <div class="is-flex is-justify-content-space-between is-align-items-center mb-5">
                <h3 class="title is-4">Criar novo funcionário</h3>
                <button class="button is-warning" onclick="history.back()">
                    <i class="fas fa-arrow-left mr-3"></i> Voltar
                </button>
            </div>
            <form action="#" @submit.prevent="submit()">
                <div class="field">
                    <label class="label">Nome</label>
                    <div class="control has-icons-left">
                        <input v-model="form.name" class="input" type="text" placeholder="John Doe">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label">E-mail</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="form.email" class="input" type="email" placeholder="johndoe@ticto.com" value="">
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label">CPF</label>
                    <div class="control has-icons-left">
                        <input v-model="form.cpf" class="input" type="text" placeholder="000.000.000-00" maxlength="14">
                        <span class="icon is-small is-left">
                            <i class="fas fa-id-card"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Senha</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="form.password" id="password" class="input" type="password"
                            placeholder="Digite sua senha">
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Cargo</label>
                    <div class="control has-icons-left">
                        <input v-model="form.cargo" class="input" type="text" placeholder="Desenvolvedor Backend">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user-tie"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Data de nascimento</label>
                    <div class="control has-icons-left">
                        <input v-model="form.data_nascimento" class="input" type="date" name="data">
                        <span class="icon is-small is-left">
                            <i class="fas fa-calendar"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">CEP</label>
                    <p class="mb-3">
                        Escreva o CEP do funcionário e clique no botão ao lado para buscarmos o endereço no serviço
                        Busca CEP.
                    </p>

                    <div class="field has-addons is-flex is-flex-direction-column">
                        <div class="is-flex">
                            <div class="control is-expanded">
                                <input v-model="form.cep" v-maska="'########'" class="input"
                                    :class="{ 'is-danger': errorCepMessage }" type="number"
                                    placeholder="Escreva o CEP do funcionário">
                            </div>
                            <div class="control">
                                <form action="#" @submit.prevent="buscarCep">
                                    <button class="button is-link" type="submit" :disabled="!form.cep">
                                        Buscar
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p v-if="errorCepMessage" class="help is-danger">{{ errorCepMessage }}</p>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Endereço (Preenchido via Busca CEP)</label>
                    <div class="control">
                        <textarea v-model="form.endereco" class="textarea" placeholder="Endereço" disabled></textarea>
                    </div>
                </div>

                <div v-if="form.endereco" class="field">
                    <label class="label">Número</label>
                    <div class="control">
                        <input class="input" type="text" inputmode="numeric" pattern="[0-9]*" placeholder="Ex.: 123"
                            v-model="numero">
                    </div>
                    <p class="help">Use apenas números. Informe bloco/apto no campo Complemento.</p>
                </div>
                <div class="field is-grouped is-flex is-justify-content-end">
                    <div class="control">
                        <button class="button is-black">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </DashboardLayout>
</template>