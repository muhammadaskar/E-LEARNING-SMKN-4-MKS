<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">Akun Guru</h1>
          <!-- {{ surveys }} -->
          <router-link
            :to="{ name: 'AddTeacherAccount' }"
            class="
              py-2
              px-3
              text-white
              bg-emerald-500
              rounded-md
              hover:bg-emerald-600
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 -mt-1 inline-block"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 4v16m8-8H4"
              /></svg
            >Tambah akun guru</router-link
          >
        </div>
      </template>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 text-gray-400">
          <thead
            class="
              text-xs text-gray-700
              uppercase
              bg-gray-50 bg-white-700
              text-gray-400
            "
          >
            <tr>
              <th scope="col" class="px-6 py-3">Nama</th>
              <th scope="col" class="px-6 py-3">Email</th>
              <th scope="col" class="px-6 py-3">NIP</th>
              <th scope="col" class="px-6 py-3">Status Akun</th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b bg-gray-800 border-gray-700">
              <th
                scope="row"
                class="
                  px-6
                  py-4
                  font-medium
                  text-gray-900 text-white
                  whitespace-nowrap
                "
              >
                Apple MacBook Pro 17"
              </th>
              <td class="px-6 py-4">Sliver</td>
              <td class="px-6 py-4">Laptop</td>
              <td class="px-6 py-4">$2999</td>
              <td class="px-6 py-4 text-right">
                <a
                  href="#"
                  class="
                    font-medium
                    text-blue-600 text-blue-500
                    hover:underline
                  "
                  >Edit</a
                >
              </td>
            </tr>
            <tr class="bg-white border-b bg-gray-800 border-gray-700">
              <th
                scope="row"
                class="
                  px-6
                  py-4
                  font-medium
                  text-gray-900 text-white
                  whitespace-nowrap
                "
              >
                Microsoft Surface Pro
              </th>
              <td class="px-6 py-4">White</td>
              <td class="px-6 py-4">Laptop PC</td>
              <td class="px-6 py-4">$1999</td>
              <td class="px-6 py-4 text-right">
                <a
                  href="#"
                  class="
                    font-medium
                    text-blue-600 text-blue-500
                    hover:underline
                  "
                  >Edit</a
                >
              </td>
            </tr>
            <tr class="bg-white bg-gray-800">
              <th
                scope="row"
                class="
                  px-6
                  py-4
                  font-medium
                  text-gray-900 text-white
                  whitespace-nowrap
                "
              >
                Magic Mouse 2
              </th>
              <td class="px-6 py-4">Black</td>
              <td class="px-6 py-4">Accessories</td>
              <td class="px-6 py-4">$99</td>
              <td class="px-6 py-4 text-right">
                <a
                  href="#"
                  class="
                    font-medium
                    text-blue-600 text-blue-500
                    hover:underline
                  "
                  >Edit</a
                >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </PageComponent>
  </div>
</template>

<script setup>
import PageComponent from "../../../components/PageComponent.vue";
</script>

<style>
</style>