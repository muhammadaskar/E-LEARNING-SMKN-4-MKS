
<template>
  <div>
    <div>
      <img
        class="mx-auto h-20 w-auto"
        src="https://smkn4makassar.sch.id/assets/images/logo.png"
        alt="Workflow"
      />
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Pilih akun
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        atau
        {{ " " }}
        <router-link
          :to="{ name: 'Login' }"
          class="font-medium text-indigo-600 hover:text-indigo-500"
        >
          login di sini
        </router-link>
      </p>
    </div>
    <!-- Tambahkan -->
    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
      <div
        class="
          border border-white-300
          shadow
          rounded-md
          p-4
          w-full
          mx-auto
          mb-2
          text-left
          hover:ring-2
          focus:outline-none focus:ring-2 focus:ring-offset-2
        "
      >
        <router-link
          :to="{
            name: 'RegisterAccount',
            params: { id: 1, role: 'teacher' },
          }"
        >
          <p class="font-bold">Guru</p>
          <p class="text-sm">
            Khusus akun guru mata pelajaran Simulasi Digital Kelas X
          </p>
        </router-link>
      </div>
      <div
        class="
          border border-white-300
          shadow
          rounded-md
          p-4
          w-full
          mx-auto
          mb-2
          text-left
          hover:ring-2
          focus:outline-none focus:ring-2 focus:ring-offset-2
        "
      >
        <router-link
          :to="{
            name: 'RegisterAccount',
            params: { id: 2, role: 'student' },
          }"
        >
          <p class="font-bold">Siswa</p>
          <p class="text-sm">
            Khusus akun peserta didik mata pelajaran Simulasi Digital Kelas X
          </p>
        </router-link>
      </div>
      <div
        class="
          border border-white-300
          shadow
          rounded-md
          p-4
          w-full
          mx-auto
          mb-2
          text-left
          hover:ring-2
          focus:outline-none focus:ring-2 focus:ring-offset-2
        "
      >
        <router-link
          :to="{
            name: 'RegisterAccount',
            params: { id: 2, role: 'parent' },
          }"
        >
          <p class="font-bold">Orang tuas siswa</p>
          <p class="text-sm">
            Khusus akun orang tua siswa mata pelajaran Simulasi Digital Kelas X
          </p>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { LockClosedIcon } from "@heroicons/vue/solid";
import store from "../store";
import { useRouter } from "vue-router";

const router = useRouter();

const user = {
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  gender: "",
  address: "",
  nik: "",
};

function register(e) {
  e.preventDefault();
  store.dispatch("register", user).then(() => {
    router.push({
      name: "Dashboard",
    });
  });
}
</script>