<script setup>
import { reactive } from 'vue'
import logoImage from '/resources/images/logo.svg'

const form = reactive({
  email: '',
  password: '',
  remember: false,
  processing: false
})
</script>

<template>
  <section class="section tictoponto">
    <div class="container">
      <div class="columns is-centered">
        <div class="column is-5">
          <div class="is-flex is-justify-content-space-between is-align-items-center mb-5">
            <img :src="logoImage" class="logo" alt="Ticto Logotipo">
            <p class="has-text-weight-light">Gestão de Ponto Eletrônico</p>
          </div>

          <div class="box">
            <form action="#">
              <!-- Email -->
              <div class="field">
                <label class="label">E-mail</label>
                <div class="control has-icons-left">
                  <input
                    v-model="form.email"
                    type="email"
                    class="input"
                    placeholder="Digite seu e-mail"
                    required
                    autofocus
                  />
                  <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                  </span>
                </div>
              </div>

              <!-- Password -->
              <div class="field">
                <label class="label">Senha</label>
                <div class="control has-icons-left">
                  <input
                    v-model="form.password"
                    type="password"
                    class="input"
                    placeholder="Digite sua senha"
                    required
                    autocomplete="current-password"
                  />
                  <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                  </span>
                </div>
              </div>

              <!-- Remember -->
              <div class="field">
                <label class="checkbox">
                  <input v-model="form.remember" type="checkbox" />
                  Lembrar-me
                </label>
              </div>

              <!-- Submit -->
              <div class="field">
                <div class="control">
                  <button
                    class="button is-primary is-fullwidth"
                    :class="{ 'is-loading': form.processing }"
                    :disabled="form.processing"
                  >
                    Entrar
                  </button>
                </div>
              </div>
            </form>
          </div>

          <p class="has-text-centered is-size-7">
            Esqueceu sua senha?<a class="ml-1" href="#">Recupere aqui</a>.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>