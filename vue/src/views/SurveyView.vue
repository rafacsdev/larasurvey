<template>
    <PageComponentVue>        
        <template v-slot:header>
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ model.id ? model.tile : "Adicionando nova pesquisa" }}
                </h1>
                <div class="flex">
                <TButton v-if="model.slug" link :href="`/view/survey/${model.slug}`" target="_blank" class="mr-2">
                    <ExternalLinkIcon class="w-5 h-5" />
                    View Public link
                </TButton>
                <TButton v-if="route.params.id" color="red" @click="deleteSurvey()">
                    <TrashIcon class="w-5 h-5 mr-2" />
                    Delete
                </TButton>
                </div>
            </div>            
        </template>
        <form @submit.prevent="saveSurvey">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <!-- Campos -->
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">
                            Imagem
                        </label>    
                        <div class="mt-1 flex items-center">
                            <img v-if="model.image_url" :src="model.image_url" :alt="model.title" class="w-64 h-48 object-cover">
                            <span
                                v-else
                                class="flex items-center justify-center h-12 w-12 rounded-full overflow-hidden bg-gray-100"
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
                                class="relative overflow-hidden ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                <input
                                type="file"
                                @change="onImageChoose"
                                class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer"
                                />
                                Alterar
                            </button>
                        </div>
                    </div>
                    <!-- /Imagem -->
                    <!-- Titulo -->
                    <div>
                         <label for="title" class="block text-sm font-medium text-gray-700"
                        >Título</label
                        >
                        <input
                        type="text"
                        name="title"
                        id="title"
                        v-model="model.title"
                        autocomplete="survey_title"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                    </div>
                    <!-- /Titulo -->
                    <!-- Descrição -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">
                        Descrição
                        </label>
                        <div class="mt-1">
                        <textarea
                            id="description"
                            name="description"
                            rows="3"
                            v-model="model.description"
                            autocomplete="survey_description"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                            placeholder="Descreva sua pesquisa"
                        />
                        </div>    
                    </div>
                    <!-- /Descrição -->
                    <!-- Expira em -->
                    <div>
                        <label
                        for="expire_date"
                        class="block text-sm font-medium text-gray-700"
                        >Termina em</label
                        >
                        <input
                        type="date"
                        name="expire_date"
                        id="expire_date"
                        v-model="model.expire_date"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                    </div>
                    <!-- /Expira em -->
                    <!-- Status -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                        <input
                            id="status"
                            name="status"
                            type="checkbox"
                            v-model="model.status"
                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                        />
                        </div>
                        <div class="ml-3 text-sm">
                        <label for="status" class="font-medium text-gray-700"
                            >Ativa</label
                        >
                        </div>
                    </div>
                    <!--/ Status -->                    
                </div>
                <!--/ Campos -->
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <h3 class="text-2xl font-semibold flex items-center justify-between">
                        Perguntas

                        <!-- Add new question -->
                        <button
                        type="button"
                        @click="addQuestion()"
                        class="flex items-center text-sm py-1 px-4 rounded-sm text-white bg-gray-600 hover:bg-gray-700"
                        >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                            fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"
                            />
                        </svg>
                        Adicionar Pergunta
                        </button>
                        <!--/ Add new question -->
                    </h3>
                    <div v-if="!model.questions.length" class="text-center text-gray-600">
                        Você ainda não criou nenhuma pergunta
                    </div>
                    <div v-for="(question, index) in model.questions" :key="question.id">
                        <QuestionEditor
                        :question="question"
                        :index="index"
                        @change="questionChange"
                        @addQuestion="addQuestion"
                        @deleteQuestion="deleteQuestion"
                        />
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <TButton>
                        <SaveIcon class="w-5 h-5 mr-2" />
                        Salvar
                    </TButton>
                </div>
            </div>
        </form>
    </PageComponentVue>
</template>
<script setup>
import { v4 as uuidv4 } from 'uuid';
import { computed, ref, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import QuestionEditor from '../components/editor/QuestionEditor.vue';
import PageComponentVue from '../components/PageComponent.vue';
import TButton from '../components/core/TButton.vue';



import store from '../store';

const router = useRouter();
const route = useRoute();

let model = ref({
    title: "",
    status: false,
    slug: "",
    description: null,
    image: null,
    image_url: null,
    expire_date: null,
    questions: [],
});

if (route.params.id){
    model.value = store.state.surveys.find(
        (s) => s.id === parseInt(route.params.id)
    );
}

function addQuestion(index) {
    const newQuestion = {
        id: uuidv4,
        type: "text",
        question: "",
        description: null,
        data: {},
    }
    model.value.questions.splice(index, 0, newQuestion);
}

function deleteQuestion(question) {
  model.value.questions = model.value.questions.filter((q) => q !== question);
}

function questionChange(question) {
  // Important to explicitelly assign question.data.options, because otherwise it is a Proxy object
  // and it is lost in JSON.stringify()
  if (question.data.options) {
    question.data.options = [...question.data.options];
  }
  model.value.questions = model.value.questions.map((q) => {
    if (q.id === question.id) {
      return JSON.parse(JSON.stringify(question));
    }
    return q;
  });
}

function saveSurvey() {
    store.dispatch("saveSurvey", model.value).then(({  data  }) => {
        router.push({
            name: "SurveyView",
            params: {  id: data.data.id  },
        });
    });
}

 function onImageChoose(ev){
    const file = ev.target.files[0];
    const reader = new FileReader();
    reader.onload = () => {
        // The field to send on backend and apply validations
        model.value.image = reader.result;
        // The field to display here
        model.value.image_url = reader.result;
        ev.target.value = "";
    };
    reader.readAsDataURL(file);
 }

</script>