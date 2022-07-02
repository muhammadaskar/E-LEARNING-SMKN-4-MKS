<template>
  <div>
    <div>
      <img
        class="mx-auto h-20 w-auto"
        src="https://muhammadaskar.com/img/logo.png"
        alt="SMK4"
      />
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Masuk ke akun anda
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Atau
        {{ " " }}
        <router-link
          :to="{ name: 'Register' }"
          class="font-medium text-indigo-600 hover:text-indigo-500"
        >
          daftar akun di sini
        </router-link>
      </p>
    </div>
    <form class="mt-8 space-y-6" @submit="login">
      <div
        v-if="errorMsg"
        class="
          flex
          items-center
          justify-between
          py-3
          px-5
          bg-red-500
          text-white
          rounded
        "
      >
        {{ errorMsg }}
        <span @click="errorMsg = ''">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </span>
      </div>
      <input type="hidden" name="remember" value="true" />
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="email-address" class="sr-only">Alamat emal</label>
          <input
            id="email-address"
            name="email"
            type="email"
            autocomplete="email"
            v-model="user.email"
            class="
              appearance-none
              rounded-none
              relative
              block
              w-full
              px-3
              py-2
              border border-gray-300
              placeholder-gray-500
              text-gray-900
              rounded-t-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Alamat email"
          />
        </div>
        <div>
          <label for="password" class="sr-only">Kata sandi</label>
          <input
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            v-model="user.password"
            class="
              appearance-none
              rounded-none
              relative
              block
              w-full
              px-3
              py-2
              border border-gray-300
              placeholder-gray-500
              text-gray-900
              rounded-b-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Kata sandi"
          />
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input
            id="remember-me"
            name="remember-me"
            type="checkbox"
            v-model="user.remember"
            class="
              h-4
              w-4
              text-indigo-600
              focus:ring-indigo-500
              border-gray-300
              rounded
            "
          />
          <label for="remember-me" class="ml-2 block text-sm text-gray-900">
            Ingat saya
          </label>
        </div>
      </div>

      <div>
        <button
          type="submit"
          class="
            group
            relative
            w-full
            flex
            justify-center
            py-2
            px-4
            border border-transparent
            text-sm
            font-medium
            rounded-md
            text-white
            bg-indigo-600
            hover:bg-indigo-700
            focus:outline-none
            focus:ring-2
            focus:ring-offset-2
            focus:ring-indigo-500
          "
        >
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <LockClosedIcon
              class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
              aria-hidden="true"
            />
          </span>
          <svg
            v-if="loading"
            class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
          >
            <circle
              class="opacity-25"
              cx="12"
              cy="12"
              r="10"
              stroke="currentColor"
              stroke-width="4"
            ></circle>
            <path
              class="opacity-75"
              fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
          </svg>
          Masuk
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { LockClosedIcon } from "@heroicons/vue/solid";
import store from "../store";
import { useRouter } from "vue-router";
import { ref } from "vue";
import Alert from "../components/Alert.vue";

const router = useRouter();

let errors = ref("");

const user = {
  email: "",
  password: "",
};

let loading = ref(false);

let errorMsg = ref("");

function login(e) {
  e.preventDefault();
  loading.value = true;
  store
    .dispatch("login", user)
    .then((response) => {
      loading.value = false;
      let role = response.user.role;
      if (role === "admin") {
        router.push({
          name: "Dashboard",
        });
      }
      if (role === "teacher") {
        router.push({
          name: "DashboardTeacher",
        });
      }
      if (role === "student") {
        router.push({
          name: "DashboardStudent",
        });
      }
      if (role === "parent") {
        router.push({
          name: "DashboardParent",
        });
      }
    })
    .catch((err) => {
      loading.value = false;
      errorMsg.value = err.response.data.error;
      if (err.response.status === 422) {
        errors.value = err.response.data.errors;
      }
    });
}
</script>

<style>
</style>