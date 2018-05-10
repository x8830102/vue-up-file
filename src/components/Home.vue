<template>
    <div>
        <Header></Header>
        <Navbar></Navbar> 
        <Content></Content>
    </div>
    
</template>

<script>
    import Header from './Header.vue'
    import Navbar from './Navbar.vue'
    import Content from './Content.vue'
    export default {
        name: 'Home',
        components: {
            Header,
            Navbar,
            Content
        },
        data () {
          
        } 
    }
</script>