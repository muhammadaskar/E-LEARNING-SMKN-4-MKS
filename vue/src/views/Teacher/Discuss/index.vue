<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">Diskusi</h1>
          <router-link
            :to="{ name: 'TeacherAddDiscuss' }"
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
            >Tambah diskusi
          </router-link>
        </div>
      </template>
      <div v-if="discusses.loading" class="justify-center">
        <div
          class="
            border border-white-300
            shadow
            rounded-md
            p-6
            w-full
            mx-auto
            mb-2
          "
          v-for="n in 3"
          :key="n"
        >
          <div class="animate-pulse flex space-x-4">
            <div class="flex-1 space-y-6 py-1">
              <div class="h-2 bg-slate-700 rounded"></div>
              <div class="h-2 bg-slate-700 rounded"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- List Materi -->
      <div
        v-else
        class="relative overflow-x-auto shadow-md sm:rounded-lg p-4"
        v-for="discuss in discusses.data"
        :key="discuss.id"
      >
        <div class="flex flex-row">
          <div class="">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-12 w-12 mt-2 inline-block"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
              />
            </svg>
          </div>
          <div class="basis-5/6 pl-4">
            <h1>{{ discuss.topic }}</h1>
            <div class="">{{ discuss.created_at }}</div>
          </div>
          <div class="pt-3">
            <router-link
              :to="{
                name: 'TeacherDetailDiscuss',
                params: { id: discuss.id },
              }"
              class="
                inline-flex
                justify-center
                px-4
                border border-transparent
                shadow-sm
                text-sm
                font-medium
                rounded-md
                text-white
                bg-cyan-600
                hover:bg-cyan-700
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-cyan-500
              "
              >detail</router-link
            >
          </div>
          <div class="pt-3 pl-2">
            <button
              v-if="discuss.id"
              @click="deleteDiscuss(discuss.id)"
              type="button"
              class="
                inline-flex
                justify-center
                px-4
                border border-transparent
                shadow-sm
                text-sm
                font-medium
                rounded-md
                text-white
                bg-red-600
                hover:bg-red-700
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-red-500
              "
            >
              hapus
            </button>
          </div>
        </div>
      </div>
      <!-- End List Materi -->
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

const discusses = computed(() => store.state.discusses);
store.dispatch("getTeacherDiscusses");

function deleteDiscuss(id) {
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
      store.dispatch("deleteDiscuss", id).then(() => {
        store.commit("notify", {
          type: "success",
          message: "diskusi berhasil dihapus ",
        });
        store.dispatch("getTeacherDiscusses");
      });
    }
  });
}
</script>

<style>
</style>