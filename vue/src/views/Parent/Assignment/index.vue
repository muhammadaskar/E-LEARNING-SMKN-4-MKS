<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">
            Proses Pengerjaan Tugas Siswa
          </h1>
        </div>
      </template>
      <div v-if="assignments.loading" class="flex justify-center">
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
        <table
          v-if="keterangan != false"
          class="w-full text-sm text-left text-gray-500 text-gray-400"
        >
          <thead
            class="
              text-xs text-gray-700
              uppercase
              bg-gray-50 bg-white-700
              text-gray-400
            "
          >
            <tr>
              <th scope="col" class="px-6 py-3">Tugas</th>
              <th scope="col" class="px-6 py-3">Tenggang waktu</th>
              <th scope="col" class="px-6 py-3">Dikumpul pada</th>
              <th scope="col" class="px-6 py-3">Status Pengumpulan</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="bg-white border-b bg-gray-800 border-gray-700"
              v-for="tugas in assignments.data"
              :key="tugas.id"
            >
              <td
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 text-white"
              >
                {{ tugas.title }}
              </td>
              <td class="px-6 py-4">{{ tugas.due_date }}</td>
              <td class="px-6 py-4">
                <div v-if="tugas.status != 'belum_dikumpulkan'">
                  {{ tugas.created_at }}
                </div>
              </td>
              <td class="px-6 py-4">
                <div
                  v-if="tugas.status == 'belum_dikumpulkan'"
                  class="text-yellow-600"
                >
                  belum dikumpulkan
                </div>
                <div v-if="tugas.status == 'telat'" class="text-yellow-600">
                  telat dikumpulkan
                </div>
                <div
                  v-if="tugas.status == 'tepat waktu'"
                  class="text-green-600"
                >
                  tepat waktu
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <div v-else>Data anak (siswa) belum ada</div>
      </div>
    </PageComponent>
  </div>
</template>

<script setup>
import PageComponent from "../../../components/PageComponent.vue";
import store from "../../../store";
import { computed } from "vue";
import { useRoute, useRouter } from "vue-router";

const router = useRouter();

const route = useRoute();

const assignments = computed(() => store.state.assignments);

const keterangan = computed(() => store.state.assignments.keterangan);

store.dispatch("getAssignmentProcess");
</script>

<style>
</style>