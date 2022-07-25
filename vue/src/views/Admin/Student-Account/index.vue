<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">Akun Siswa</h1>
          <!-- {{ surveys }} -->
          <router-link
            :to="{ name: 'AddStudentAccount' }"
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
            >Tambah akun siswa</router-link
          >
        </div>
      </template>
      <div v-if="students.loading" class="flex justify-center">
        <div
          class="border border-white-300 shadow rounded-md p-4 w-full mx-auto"
        >
          <div class="animate-pulse flex space-x-4">
            <!-- <div class="rounded-full bg-slate-700 h-10 w-10"></div> -->
            <div class="flex-1 space-y-6 py-1">
              <div class="h-2 bg-slate-700 rounded"></div>
              <div class="space-y-3">
                <div class="grid grid-cols-3 gap-4">
                  <div class="h-2 bg-slate-700 rounded col-span-2"></div>
                  <div class="h-2 bg-slate-700 rounded col-span-1"></div>
                </div>
                <div class="h-2 bg-slate-700 rounded"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
              <th scope="col" class="px-6 py-3">NIS</th>
              <th scope="col" class="px-6 py-3">Status Akun</th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="bg-white border-b bg-gray-800 border-gray-700"
              v-for="student in students.data"
              :key="student.id"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 text-white"
              >
                {{ student.name }}
              </th>
              <td class="px-6 py-4">{{ student.email }}</td>
              <td class="px-6 py-4">{{ student.nis }}</td>
              <td class="px-6 py-4">
                <div v-if="student.is_active" class="text-green-600">aktif</div>
                <div v-else class="text-yellow-600">tidak aktif</div>
              </td>
              <td class="px-6 py-4 text-right">
                <router-link
                  :to="{
                    name: 'AdminEditStudentAccount',
                    params: { id: student.user_id },
                  }"
                  class="
                    font-medium
                    text-blue-600 text-blue-500
                    hover:underline
                  "
                  >edit</router-link
                >
                <button
                  v-if="student.user_id"
                  type="button"
                  @click="deleteStudentAccount(student.user_id)"
                  class="
                    pl-2
                    rounded-full
                    border border-transparent
                    text-sm text-red-500
                  "
                >
                  hapus
                </button>
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
import store from "../../../store";
import { computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import Swal from "sweetalert2";

const router = useRouter();

const route = useRoute();

const students = computed(() => store.state.students);

store.dispatch("getStudentsAccount");

function deleteStudentAccount(id) {
  Swal.fire({
    title: "",
    text: "Apakah anda yakin ingin menghapus?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ok",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      store.dispatch("deleteStudentAccount", id).then(() => {
        store.commit("notify", {
          type: "success",
          message: "akun siswa berhasil dihapus ",
        });
        store.dispatch("getStudentsAccount");
      });
    }
  });
}
</script>

<style>
</style>