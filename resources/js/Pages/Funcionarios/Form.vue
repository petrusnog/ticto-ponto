<script setup lang="ts">

import { ref } from 'vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import goTo from '@/goTo';

const props = defineProps({
    funcionario: {
        type: Object,
        default: null
    }
});

const form = useForm({
    name: props.funcionario ? props.funcionario.name : '',
    email: props.funcionario ? props.funcionario.email : '',
    cpf: props.funcionario ? props.funcionario.cpf : '',
    password: '',
    cargo: props.funcionario ? props.funcionario.cargo : '',
    data_nascimento: props.funcionario ? props.funcionario.data_nascimento : '',
    cep: props.funcionario ? props.funcionario.cep : '',
    endereco: props.funcionario ? props.funcionario.endereco : '',
    numero: '',
    complemento: ''

})

const screenMode = ref(props.funcionario ? 'edit' : 'create')
const errorMessage = ref(null)
const errorCepMessage = ref(null)
const showNumberAndComplement = ref(false)


const submit = () => {
    if (props.funcionario) {
        // Edição de funcionário.
        form.put(route('funcionarios.update', props.funcionario.id), {
            onError: () => {
                errorMessage.value = form.errors
            }
        })
    } else {
        // Criação de funcionário.
        form.post(route('funcionarios.store'), {
            onError: () => {
                errorMessage.value = form.errors
            }
        });
    }
}

const buscarCep = () => {
    // Limpando mensagem de erro.
    errorCepMessage.value = null

    const url = `/api/buscar-cep/${form.cep}`

    axios.get(url)
        .then(response => {
            form.endereco = `${response.data.logradouro}, ${response.data.bairro} - ${response.data.localidade}/${response.data.uf}`
            showNumberAndComplement.value = true
        }).catch(error => {
            errorCepMessage.value = error.response.data.error
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
            <div class="is-flex is-justify-content-space-between is-align-items-center mb-5">
                <h3 class="title is-4">{{ screenMode == 'edit' ? 'Editar' : 'Criar novo' }} funcionário</h3>
                <button class="button is-warning" @click="goTo('funcionarios.index')">
                    <i class="fas fa-arrow-left mr-3"></i> Voltar
                </button>
            </div>
            <form action="#" @submit.prevent="submit()">
                <div class="field">
                    <label class="label">Nome</label>
                    <div class="control has-icons-left">
                        <input v-model="form.name" class="input" :class="{ 'is-danger': form.errors.name }" type="text"
                            placeholder="John Doe" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <p v-if="form.errors.name" class="help is-danger">{{ form.errors.name }}</p>
                </div>

                <div class="field">
                    <label class="label">E-mail</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="form.email" class="input" :class="{ 'is-danger': form.errors.email }"
                            type="email" placeholder="johndoe@ticto.com" value="" :required="screenMode == 'create'" :disabled="screenMode == 'edit'">
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                    <p v-if="form.errors.email" class="help is-danger">{{ form.errors.email }}</p>
                </div>

                <div class="field">
                    <label class="label">CPF</label>
                    <div class="control has-icons-left">
                        <input v-model="form.cpf" class="input" :class="{ 'is-danger': form.errors.cpf }" type="text"
                            placeholder="000.000.000-00" v-maska="'###.###.###-##'" :required="screenMode == 'create'" :disabled="screenMode == 'edit'">
                        <span class="icon is-small is-left">
                            <i class="fas fa-id-card"></i>
                        </span>
                    </div>
                    <p v-if="form.errors.cpf" class="help is-danger">{{ form.errors.cpf }}</p>
                </div>

                <div class="field">
                    <label class="label">Senha</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="form.password" id="password" class="input"
                            :class="{ 'is-danger': form.errors.password }" type="password"
                            placeholder="Digite sua senha" :required="screenMode == 'create'">
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    <p v-if="form.errors.password" class="help is-danger">{{ form.errors.password }}</p>
                </div>

                <div class="field">
                    <label class="label">Cargo</label>
                    <div class="control has-icons-left">
                        <input v-model="form.cargo" class="input" :class="{ 'is-danger': form.errors.cargo }"
                            type="text" placeholder="Desenvolvedor Backend" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-user-tie"></i>
                        </span>
                    </div>
                    <p v-if="form.errors.cargo" class="help is-danger">{{ form.errors.cargo }}</p>
                </div>

                <div class="field">
                    <label class="label">Data de nascimento</label>
                    <div class="control has-icons-left">
                        <input v-model="form.data_nascimento" class="input"
                            :class="{ 'is-danger': form.errors.data_nascimento }" type="date" name="data" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-calendar"></i>
                        </span>
                    </div>
                    <p v-if="form.errors.data_nascimento" class="help is-danger">{{ form.errors.data_nascimento }}</p>
                </div>
                <div class="field">
                    <label class="label">CEP</label>
                    <div class="field has-addons is-flex is-flex-direction-column">
                        <div class="is-flex">
                            <div class="control is-expanded">
                                <input v-model="form.cep" v-maska="'########'" class="input"
                                    :class="{ 'is-danger': errorCepMessage || form.errors.cep }" type="text"
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
                        <p v-if="!errorCepMessage && !form.errors.cep" class="help">
                            Escreva o CEP do funcionário e clique no botão ao lado para buscarmos o endereço no serviço
                            Busca CEP.
                        </p>
                        <p v-if="errorCepMessage" class="help is-danger">{{ errorCepMessage }}</p>
                        <p v-if="form.errors.cep" class="help is-danger">{{ form.errors.cep }}</p>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Endereço (Preenchido via Busca CEP)</label>
                    <div class="control">
                        <textarea v-model="form.endereco" class="textarea" placeholder="Endereço" disabled></textarea>
                    </div>
                </div>

                <div v-if="form.endereco && showNumberAndComplement" class="field">
                    <label class="label">Número</label>
                    <div class="control">
                        <input class="input" type="text" inputmode="numeric" placeholder="Ex.: 123"
                            v-model="form.numero">
                    </div>
                    <p class="help">Use apenas números. Informe bloco/apto no campo Complemento.</p>
                </div>
                <div v-if="form.endereco && showNumberAndComplement" class="field">
                    <label class="label">Complemento</label>
                    <div class="control">
                        <input class="input" type="text" inputmode="numeric" placeholder="Ex.: Ap. 504, Bloco 10"
                            v-model="form.complemento">
                    </div>
                </div>
                <div class="field is-grouped is-flex is-justify-content-end">
                    <div class="control">
                        <button class="button is-black">{{ screenMode == 'edit' ? 'Atualizar' : 'Cadastrar' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </DashboardLayout>
</template>