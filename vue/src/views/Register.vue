
<template>
  <div>
    <div>
      <img
        class="mx-auto h-20 w-auto"
        src="https://muhammadaskar.com/img/logo.png"
        alt="Workflow"
      />
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Registrasi akun
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
    <form
      v-if="route.params.role == 'teacher'"
      class="mt-8 space-y-6"
      @submit="register"
    >
      <input type="hidden" name="remember" value="true" />
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="fullname" class="sr-only">Nama Lengkap</label>
          <input
            id="fullname"
            name="name"
            type="text"
            autocomplete="name"
            required=""
            v-model="teacher.name"
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
            placeholder="Nama Lengkap"
          />
        </div>
        <div>
          <label for="nip" class="sr-only">NIP</label>
          <input
            id="nip"
            name="nip"
            type="number"
            autocomplete="nip"
            required=""
            v-model="teacher.nip"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="NIP"
          />
        </div>
        <div>
          <label for="email-address" class="sr-only">Email</label>
          <input
            id="email-address"
            name="email"
            type="email"
            autocomplete="email"
            required=""
            v-model="teacher.email"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Email"
          />
        </div>
        <div>
          <label for="password" class="sr-only">Kata sandi</label>
          <input
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            required=""
            v-model="teacher.password"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Kata sandi"
          />
        </div>
        <div>
          <label for="password-confirmation" class="sr-only"
            >Konfirmasi kata sandi</label
          >
          <input
            id="password-confirmation"
            name="password_confirmation"
            type="password"
            autocomplete="current-password-confirmation"
            required=""
            v-model="teacher.password_confirmation"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Konfirmasi kata sandi"
          />
        </div>
        <div>
          <label for="gender" class="sr-only">Jenis Kelamin</label>
          <select
            id="gender"
            name="gender"
            autocomplete="gender"
            v-model="teacher.gender"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
          >
            <option value="">Jenis kelamin</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
        </div>
        <div>
          <label for="address" class="sr-only">Konfirmasi kata sandi</label>
          <textarea
            id="address"
            name="address"
            rows="3"
            v-model="teacher.address"
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
            placeholder="Alamat lengkap"
          />
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
          Daftar
        </button>
      </div>
    </form>

    <form
      v-if="route.params.role == 'student'"
      class="mt-8 space-y-6"
      @submit="register"
    >
      <input type="hidden" name="remember" value="true" />
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="fullname" class="sr-only">Nama Lengkap</label>
          <input
            id="fullname"
            name="name"
            type="text"
            autocomplete="name"
            required=""
            v-model="student.name"
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
            placeholder="Nama Lengkap"
          />
        </div>
        <div>
          <label for="nis" class="sr-only">NIS</label>
          <input
            id="nis"
            name="nis"
            type="number"
            autocomplete="nis"
            required=""
            v-model="student.nis"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="NIS"
          />
        </div>
        <div>
          <label for="email-address" class="sr-only">Email</label>
          <input
            id="email-address"
            name="email"
            type="email"
            autocomplete="email"
            required=""
            v-model="student.email"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Email"
          />
        </div>
        <div>
          <label for="password" class="sr-only">Kata sandi</label>
          <input
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            required=""
            v-model="student.password"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Kata sandi"
          />
        </div>
        <div>
          <label for="password-confirmation" class="sr-only"
            >Konfirmasi kata sandi</label
          >
          <input
            id="password-confirmation"
            name="password_confirmation"
            type="password"
            autocomplete="current-password-confirmation"
            required=""
            v-model="student.password_confirmation"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Konfirmasi kata sandi"
          />
        </div>
        <div>
          <label for="gender" class="sr-only">Jenis Kelamin</label>
          <select
            id="gender"
            name="gender"
            autocomplete="gender"
            v-model="student.gender"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
          >
            <option value="">Jenis kelamin</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
        </div>
        <div>
          <label for="address" class="sr-only">Konfirmasi kata sandi</label>
          <textarea
            id="address"
            name="address"
            rows="3"
            v-model="student.address"
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
            placeholder="Alamat lengkap"
          />
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
          Daftar
        </button>
      </div>
    </form>
    <form
      v-if="route.params.role == 'parent'"
      class="mt-8 space-y-6"
      @submit="register"
    >
      <input type="hidden" name="remember" value="true" />
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="fullname" class="sr-only">Nama Lengkap</label>
          <input
            id="fullname"
            name="name"
            type="text"
            autocomplete="name"
            required=""
            v-model="parent.name"
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
            placeholder="Nama Lengkap"
          />
        </div>
        <div>
          <label for="nik" class="sr-only">NIK</label>
          <input
            id="nik"
            name="nik"
            type="number"
            autocomplete="nik"
            required=""
            v-model="parent.nik"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="NIK"
          />
        </div>
        <div>
          <label for="email-address" class="sr-only">Email</label>
          <input
            id="email-address"
            name="email"
            type="email"
            autocomplete="email"
            required=""
            v-model="parent.email"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Email"
          />
        </div>
        <div>
          <label for="password" class="sr-only">Kata sandi</label>
          <input
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            required=""
            v-model="parent.password"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Kata sandi"
          />
        </div>
        <div>
          <label for="password-confirmation" class="sr-only"
            >Konfirmasi kata sandi</label
          >
          <input
            id="password-confirmation"
            name="password_confirmation"
            type="password"
            autocomplete="current-password-confirmation"
            required=""
            v-model="parent.password_confirmation"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
            placeholder="Konfirmasi kata sandi"
          />
        </div>
        <div>
          <label for="gender" class="sr-only">Jenis Kelamin</label>
          <select
            id="gender"
            name="gender"
            autocomplete="gender"
            v-model="parent.gender"
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
              rounded-md
              focus:outline-none
              focus:ring-indigo-500
              focus:border-indigo-500
              focus:z-10
              sm:text-sm
            "
          >
            <option value="">Jenis kelamin</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
        </div>
        <div>
          <label for="address" class="sr-only">Konfirmasi kata sandi</label>
          <textarea
            id="address"
            name="address"
            rows="3"
            v-model="parent.address"
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
            placeholder="Alamat lengkap"
          />
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
          Daftar
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { LockClosedIcon } from "@heroicons/vue/solid";
import store from "../store";
import { useRoute, useRouter } from "vue-router";

const router = useRouter();
const route = useRoute();

const teacher = {
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  gender: "",
  address: "",
  nip: "",
  role: "teacher",
};

const student = {
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  gender: "",
  address: "",
  nis: "",
  role: "student",
};

const parent = {
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  gender: "",
  address: "",
  nik: "",
  role: "parent",
};

function register(e) {
  e.preventDefault();
  if (route.params.role == "teacher") {
    store.dispatch("register", teacher).then(() => {
      router.push({
        name: "Dashboard",
      });
    });
  } else if (route.params.role == "student") {
    store.dispatch("register", student).then(() => {
      router.push({
        name: "Dashboard",
      });
    });
  } else if (route.params.role == "parent") {
    store.dispatch("register", parent).then(() => {
      router.push({
        name: "Dashboard",
      });
    });
  } else {
    console.log("role tidak ditemukan");
  }
}
</script>