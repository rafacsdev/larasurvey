<template>
      <div>
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Cadastre-se Gratuitamente</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Ou
          {{ ' ' }}
         <router-link :to="{name: 'Login'}" class="font-medium text-indigo-600 hover:text-indigo-500"> Acesse sua conta </router-link>
        </p>
      </div>
      <form class="mt-8 space-y-6" @submit="register">
       <div v-if="errorMsg" class="flex items-center justify-between py-3 px-5 bg-red-400 text-white rounded">
      {{ errorMsg }}
      <span @click="errorMsg = ''" class="w-6 h-6 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-red-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
      </span>
      </div>
        <div class="rounded-md shadow-sm -space-y-px">
           <div>
            <label for="nome" class="sr-only">Seu nome</label>
            <input id="nome" name="nome" type="text" autocomplete="name" v-model="user.name" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Seu Nome" />
          </div>
          <div>
            <label for="email-address" class="sr-only">Seu email</label>
            <input id="email-address" name="email" type="email" v-model="user.email" autocomplete="email" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Seu email" />
          </div>
          <div>
            <label for="password" class="sr-only">Sua senha</label>
            <input id="password" name="password" type="password" v-model="user.password" autocomplete="current-password" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Sua Senha" />
          </div>
          <div>
            <label for="password_confirmation" class="sr-only">Repita a senha</label>
            <input id="password_confirmation" name="password_confirmation" v-model="user.password_confirmation" type="password" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Repita a Senha" />
          </div>
        </div>

        <div>
          <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
            </span>
            Cadastrar
          </button>
        </div>
      </form>
</template>

<script setup>
import { LockClosedIcon } from '@heroicons/vue/solid'
import { useRouter } from 'vue-router';
import store from '../store';
import { ref } from 'vue';

const router = useRouter();
const user = {
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
}
let errorMsg = ref('');

function register(ev) {
  ev.preventDefault();
  store
    .dispatch('register', user)
    .then((res) => {
      router.push({
        name: 'Dashboard'
      })
    })
    .catch(err => {
      errorMsg.value = err.response.data.error
    });
}
</script>