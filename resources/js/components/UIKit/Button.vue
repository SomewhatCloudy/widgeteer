<template>
    <div class="component button" :class="{ok: ok, clear: clear, arrow: arrow}">
        <slot></slot>
    </div>
</template>
<script>

export default {
    props: [
        'ok',
        'clear',
        'arrow'
    ],
    data() {
        return {
        }
    }
}
</script>

