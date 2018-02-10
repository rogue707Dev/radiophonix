<template>
    <div>
        Exemple de sous-élément: {{ firstName }} {{ age }}
    </div>
</template>

<script>
export default {
    props: ['firstName', 'age']
}
</script>
