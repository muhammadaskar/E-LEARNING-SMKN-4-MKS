<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">Akun Siswa</h1>
        </div>
      </template>
      <div class="grid grid-cols-2 gap-2">
        <div class="mt-12">
          <img
            src="https://img.freepik.com/free-vector/teacher-character-collection_23-2148517110.jpg?w=2000"
          />
        </div>
        <div
          v-if="studentLoading"
          class="justify-center shadow sm:rounded-md sm:overflow-hidden"
        >
          <div class="p-6 w-full mx-auto">
            <div
              class="mb-2 animate-pulse flex space-x-4"
              v-for="n in 9"
              :key="n"
            >
              <div class="flex-1 space-y-4 py-1">
                <div class="h-2 bg-slate-700 rounded"></div>
              </div>
            </div>
          </div>
        </div>
        <form
          v-else
          class="animate-fade-in-down row-span-3"
          @submit.prevent="saveStudent"
        >
          <Alert
            v-if="Object.keys(errors).length"
            class="flex-col items-stretch text-sm"
          >
            <div v-for="(field, i) of Object.keys(errors)" :key="i">
              <div v-for="(error, ind) of errors[field] || []" :key="ind">
                * {{ error }}
              </div>
            </div>
          </Alert>
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <!-- Teacher Account Fields -->
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <!-- Image -->
              <div>
                <label class="block text-sm font-medium text-gray-700">
                  Foto
                </label>
                <div class="mt-1 flex items-center">
                  <img
                    class="w-64 h-48 object-cover"
                    v-if="model.foto_url"
                    :src="model.foto_url"
                  />
                  <span
                    v-else
                    class="
                      flex
                      items-center
                      justify-center
                      h-12
                      w-12
                      rounded-full
                      overflow-hidden
                      bg-gray-100
                    "
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-[80%] w-[80%] text-gray-300"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </span>
                  <button
                    type="button"
                    class="
                      relative
                      overflow-hidden
                      ml-5
                      bg-white
                      py-2
                      px-3
                      border border-gray-300
                      rounded-md
                      shadow-sm
                      text-sm
                      leading-4
                      font-medium
                      text-gray-700
                      hover:bg-gray-50
                      focus:outline-none
                      focus:ring-2
                      focus:ring-offset-2
                      focus:ring-indigo-500
                    "
                  >
                    <input
                      type="file"
                      @change="onImageChoose"
                      class="
                        absolute
                        left-0
                        top-0
                        right-0
                        bottom-0
                        opacity-0
                        cursor-pointer
                      "
                    />
                    ganti
                  </button>
                </div>
              </div>
              <!--/ Image -->

              <!-- Nama -->
              <div>
                <label
                  for="name"
                  class="block text-sm font-medium text-gray-700"
                  >Nama</label
                >
                <input
                  type="text"
                  name="name"
                  id="name"
                  autocomplete="name"
                  v-model="model.name"
                  class="
                    mt-1
                    focus:ring-indigo-500 focus:border-indigo-500
                    block
                    w-full
                    shadow-sm
                    sm:text-sm
                    border-gray-300
                    rounded-md
                  "
                />
              </div>
              <!--/ Nama -->

              <!-- Email -->
              <div>
                <label
                  for="email"
                  class="block text-sm font-medium text-gray-700"
                  >Email</label
                >
                <input
                  type="email"
                  name="email"
                  id="email"
                  autocomplete="email"
                  v-model="model.email"
                  class="
                    mt-1
                    focus:ring-indigo-500 focus:border-indigo-500
                    block
                    w-full
                    shadow-sm
                    sm:text-sm
                    border-gray-300
                    rounded-md
                  "
                />
              </div>
              <!--/ Email -->

              <!-- Password -->
              <div>
                <label
                  for="password"
                  class="block text-sm font-medium text-gray-700"
                  >Kata sandi</label
                >
                <input
                  type="password"
                  name="password"
                  id="password"
                  autocomplete="password"
                  v-model="model.password"
                  class="
                    mt-1
                    focus:ring-indigo-500 focus:border-indigo-500
                    block
                    w-full
                    shadow-sm
                    sm:text-sm
                    border-gray-300
                    rounded-md
                  "
                />
              </div>
              <!--/ Password -->

              <!-- Password Confirmation -->
              <div>
                <label
                  for="password-confirmation"
                  class="block text-sm font-medium text-gray-700"
                  >Konfrimasi kata sandi</label
                >
                <input
                  type="password"
                  name="password_confirmation"
                  id="password-confirmation"
                  autocomplete="current-password-confirmation"
                  v-model="model.password_confirmation"
                  class="
                    mt-1
                    focus:ring-indigo-500 focus:border-indigo-500
                    block
                    w-full
                    shadow-sm
                    sm:text-sm
                    border-gray-300
                    rounded-md
                  "
                />
              </div>
              <!--/ Password Confirmation -->

              <!-- NIs -->
              <div>
                <label for="nis" class="block text-sm font-medium text-gray-700"
                  >NIS</label
                >
                <input
                  type="number"
                  name="nis"
                  id="nis"
                  autocomplete="nis"
                  v-model="model.nis"
                  class="
                    mt-1
                    focus:ring-indigo-500 focus:border-indigo-500
                    block
                    w-full
                    shadow-sm
                    sm:text-sm
                    border-gray-300
                    rounded-md
                  "
                />
              </div>
              <!--/ NIs -->

              <!-- GENDER -->
              <div>
                <label
                  for="gender"
                  class="block text-sm font-medium text-gray-700"
                  >Jenis Kelamin</label
                >
                <select
                  id="gender"
                  name="gender"
                  autocomplete="gender"
                  v-model="model.gender"
                  class="
                    mt-1
                    block
                    w-full
                    py-2
                    px-3
                    border border-gray-300
                    bg-white
                    rounded-md
                    shadow-sm
                    focus:outline-none
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    sm:text-sm
                  "
                >
                  <!-- <div v-if="model.gender=='L'">
                    <option value="L" selected>Laki-laki</option>
                    <option value="P">Perempuan</option>
                 </div> -->
                  <option value="L" v-if="model.gender == 'L'" selected>
                    Laki-laki
                  </option>
                  <option value="P" v-if="model.gender == 'L'">
                    Perempuan
                  </option>
                  <option value="P" v-if="model.gender == 'P'" selected>
                    Perempuan
                  </option>
                  <option value="P" v-if="model.gender == 'P'">
                    Laki-laki
                  </option>
                </select>
              </div>
              <!--/ GENDER -->

              <!-- ADDRESS -->
              <div>
                <label
                  for="address"
                  class="block text-sm font-medium text-gray-700"
                  >Alamat</label
                >
                <textarea
                  id="about"
                  name="about"
                  rows="3"
                  v-model="model.address"
                  class="
                    shadow-sm
                    focus:ring-indigo-500 focus:border-indigo-500
                    mt-1
                    block
                    w-full
                    sm:text-sm
                    border border-gray-300
                    rounded-md
                  "
                  placeholder="Sudiang raya"
                />
              </div>
              <!--/ ADDRESS -->
            </div>
            <!--/ Teacher Account Fields -->

            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button
                type="submit"
                class="
                  inline-flex
                  justify-center
                  py-2
                  px-4
                  border border-transparent
                  shadow-sm
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
                Simpan
              </button>
            </div>
          </div>
        </form>
      </div>
    </PageComponent>
  </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import PageComponent from "../../../components/PageComponent.vue";
import { useRoute, useRouter } from "vue-router";
import store from "../../../store";
import Alert from "../../../components/Alert.vue";

const router = useRouter();

const route = useRoute();

let loading = ref(false);

let model = ref({
  user_id: "",
  name: "",
  email: "",
  passowrd: "",
  password_confirmation: "",
  nis: "",
  foto: null,
  foto_url: null,
  gender: "",
  address: "",
});

function onImageChoose(e) {
  const file = e.target.files[0];
  const reader = new FileReader(file);
  reader.onload = () => {
    // the field to send on backend and apply validations
    model.value.foto = reader.result;

    // the field to display here
    model.value.foto_url = reader.result;
  };
  reader.readAsDataURL(file);
}

const studentLoading = computed(() => store.state.students.loading);

watch(
  () => store.state.currentStudent.data,
  (newVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
      status: newVal.status !== "draft",
    };
  }
);

store.dispatch("studentGetAccount");

let errors = ref("");

function saveStudent() {
  loading.value = true;
  if (
    model.value.name == "" ||
    model.value.email == "" ||
    model.value.nis == "" ||
    model.value.gender == "" ||
    model.value.address == ""
  ) {
    loading.value = false;
    store.commit("notify", {
      type: "failed",
      message: "data tidak boleh kosong",
    });
  } else {
    store
      .dispatch("studentEditAccount", model.value)
      .then(({ data }) => {
        loading.value = false;
        errors.value = "";
        store.commit("notify", {
          type: "success",
          message: "akun anda berhasil disimpan ",
        });
        router.push({
          name: "StudentAccount",
        });
      })
      .catch((error) => {
        loading.value = false;
        if (error.response.status === 422) {
          errors.value = error.response.data.errors;
        }
      });
  }
}
</script>

<style>
</style>