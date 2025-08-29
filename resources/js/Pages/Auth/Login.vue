<script setup>

import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthLayout from '../../Layouts/AuthLayout.vue'

const form = useForm({
  email: '',
  password: '',
  processing: false
})

const errorMessage = ref(null)

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
    onError: () => {
      errorMessage.value = form.errors.email
    }
  });
}

</script>

<template>
  <AuthLayout>
    <div v-if="errorMessage" class="notification is-danger">
      {{ errorMessage }}
    </div>
    <div class="box">
      <form action="#" @submit.prevent="submit()">
        <!-- Email -->
        <div class="field">
          <label class="label">E-mail</label>
          <div class="control has-icons-left">
            <input v-model="form.email" type="email" class="input" placeholder="Digite seu e-mail" required autofocus />
            <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
          </div>
        </div>

        <!-- Password -->
        <div class="field">
          <label class="label">Senha</label>
          <div class="control has-icons-left">
            <input v-model="form.password" type="password" class="input" placeholder="Digite sua senha" required
              autocomplete="current-password" />
            <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
          </div>
        </div>

        <!-- Submit -->
        <div class="field">
          <div class="control">
            <button class="button is-primary is-fullwidth" :class="{ 'is-loading': form.processing }"
              :disabled="form.processing">
              Entrar
            </button>
          </div>
        </div>
      </form>
    </div>

    <p class="has-text-centered is-size-7">
      Esqueceu sua senha?<a class="ml-1" href="#">Recupere aqui</a>.
    </p>
  </AuthLayout>
</template>