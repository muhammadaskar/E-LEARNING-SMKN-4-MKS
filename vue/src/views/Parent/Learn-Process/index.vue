<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">Proses Belajar Siswa</h1>
        </div>
      </template>
      <div v-if="learn_process.loading" class="flex justify-center">
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
              <th scope="col" class="px-6 py-3">Materi</th>
              <th scope="col" class="px-6 py-3">Tanggal</th>
              <th scope="col" class="px-6 py-3">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="bg-white border-b bg-gray-800 border-gray-700"
              v-for="materi in learn_process.data"
              :key="materi.id"
            >
              <td
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 text-white"
              >
                {{ materi.title }}
              </td>
              <td class="px-6 py-4">{{ materi.created_at }}</td>
              <td class="px-6 py-4">
                <div
                  v-if="materi.status_pengerjaan == 'belum'"
                  class="text-yellow-600"
                >
                  belum dikerjakan
                </div>
                <div v-else class="text-green-600">selesai</div>
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

const router = useRouter();

const route = useRoute();

const learn_process = computed(() => store.state.learn_process);

store.dispatch("getLearnProcess");
</script>

<style>
</style>