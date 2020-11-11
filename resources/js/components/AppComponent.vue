<template>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">                    
                    <transition name="slide-fade" mode="out-in">
                        <router-view :key="$route.fullPath"></router-view>
                    </transition>
                </div>
            </div>
        </div>
    </div>
    
</template>
