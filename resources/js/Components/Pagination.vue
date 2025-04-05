<template>
    <nav aria-label="Pagination" class="py-3">
        <ul :class="`flex ${alignmentClasses} list-none p-0 m-0`">
            <li v-for="(link, index) in links" :key="index" 
                :class="[
                    'mx-1',
                    link.url == null ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer',
                    link.active ? 'font-bold' : '',
                ]">
                <Link 
                    :class="[
                        'px-3 py-1 rounded-md',
                        link.active 
                            ? 'bg-blue-600 text-white hover:bg-blue-700' 
                            : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100',
                    ]"
                    :href="link.url === null ? '#' : link.url" 
                    v-html="link.label">
                </Link>
            </li>
        </ul>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

export default {
    props: {
        links: Array,
        align: {
            type: String,
            default: 'center',
            validator: (value) => ['left', 'center', 'right'].includes(value)
        }
    },
    
    components: {
        Link,
    },
    
    setup(props) {
        const alignmentClasses = computed(() => {
            switch (props.align) {
                case 'left':
                    return 'justify-start';
                case 'right':
                    return 'justify-end';
                case 'center':
                default:
                    return 'justify-center';
            }
        });
        
        return {
            alignmentClasses
        };
    }
}
</script>