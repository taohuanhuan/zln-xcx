import Vue from 'vue'
import App from './App'
import ColorfulLabel from './components/ColorfulLabel.vue'
import CustomComponent from './components/CustomComponent.vue'


// 配置 Vue
Vue.config.productionTip = false

// 全局注册组件
Vue.component('custom-component', CustomComponent)

import uView from '@/uni_modules/uview-ui'
Vue.use(uView)

import httpConfig from '@/config/request'
httpConfig()          

	// //	调用setConfig方法， 方法内部会进行对象属性深度合并， 可以放心嵌套配置
	// // 需要在Vue.use(uView)之后执行
	// uni.$u.setConfig({
	// 	// 修改$u.config对象的属性
	// 	config: {
	// 		// 修改默认单位为rpx，相当于执行 uni.$u.config.unit = 'rpx'
	// 		unit: 'rpx'
	// 	},
	// 	// 修改$u.props对象的属性
	// 	props: {
	// 		// 修改radio组件的size参数的默认值，相当于执行 uni.$u.props.radio.size = 30
	// 		radio: {
	// 			size: 15
	// 		}
	// 		// 其他组件属性配置
	// 		// ......
	// 	}
	// })
// 设置应用的类型
App.mpType = 'app'

// 创建并挂载根实例
const app = new Vue({
	...App
})
app.$mount()