<template>
    <div>
        Il faut obligatoirement un tag qui englobe tout l'élément (ici c'est la div).

        <bar first-name="John" age="20"></bar>
    </div>
</template>

<script>
import Bar from '~/components/example/Bar';

export default {
    components: {
        'bar': Bar
    }
}
</script>
