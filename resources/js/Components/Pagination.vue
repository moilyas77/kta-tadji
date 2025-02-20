<script setup>
import { Link } from '@inertiajs/vue3';
import { usePaginationStore } from '../stores/pagination';
import { computed } from 'vue';
const { paginator } = defineProps({
    paginator: {
        type: Object,
        required: true
    }
});

const getLabel = (i) => {
    if (i == 0) {
        return '«';
    } else if (i == paginator.links.length - 1) {
        return '»';
    } else {
        return paginator.links[i].label;
    }
}

const getDataTip = (i) => {
    if (i == 0) {
        return 'Previous Page';
    } else if (i == paginator.links.length - 1) {
        return 'Next Page';
    } else {
        return 'Page ' + getLabel(i);
    }
}

paginator.links.forEach((link, i) => {
    link.disabled = !link.url;
    link.label = getLabel(i);
    link.data_tip = getDataTip(i);
});

const paginationStore = usePaginationStore();
const generateUrl = (url) => {
    let result = '';

    if(url){
        const searchKey = paginationStore.getSearchKey;

        if(searchKey != '' && searchKey != null){
            result = url + '&search=' + searchKey;
        }else{
            result = url;
        }
    }

    return result;
    
}
</script>

<template>
    <div class="flex flex-col gap-2">
        <div class="join">
            <div v-for="link in paginator.links" :key="link.url" :class="{
                'tooltip': link.url,
            }" :data-tip="link.data_tip">
                <Link :disabled="link.url ? null : true" :class="{
                    'btn-active font-semibold': link.active,
                    'font-normal': !link.active,
                }" :href="generateUrl(link.url)" class="join-item btn btn-xs" preserve-scroll preserve-state>
                    <span v-html="link.label"></span>
                </Link>
            </div>
        </div>
        <span class="text-xs mx-auto">
            {{ 'Showing ' + (paginator.from ?? '0') + ' to ' + (paginator.to ?? '0') + ' of ' + paginator.total + ' results' }}
        </span>
    </div>
</template>

<style scoped></style>