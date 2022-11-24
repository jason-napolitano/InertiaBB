import { ElementPlusResolver } from 'unplugin-vue-components/resolvers'
import inertia from './resources/scripts/vite/inertia-layout'
import Components from 'unplugin-vue-components/vite'
import AutoImport from 'unplugin-auto-import/vite'
import laravel from 'vite-plugin-laravel'
import vue from '@vitejs/plugin-vue'
import { defineConfig } from 'vite'

export default defineConfig({
	plugins: [
		inertia(),
		vue(),
		laravel(),
		AutoImport({
			resolvers: [ElementPlusResolver()]
		}),
		Components({
			resolvers: [ElementPlusResolver()]
		}),
	],
})
