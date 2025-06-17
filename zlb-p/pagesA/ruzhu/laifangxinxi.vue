<template>
	<view class="main">
		<view class="card">
			<view class="title">来访信息填写</view>
			<view class="item">
				<view class="left"><text class="required">*</text>真实姓名</view>
				<view class="right">
					<input placeholder="请输入真实姓名" v-model="residentName" />
				</view>
			</view>
			<view class="item">
				<view class="left"><text class="required">*</text>年龄</view>
				<view class="right">
					<input placeholder="请输入年龄" v-model="residentAge" />
				</view>
			</view>
			<view class="item">
				<view class="left"><text class="required">*</text>性别</view>
				<view class="right">
					<u-radio-group v-model="residentSex" placement="row">
						<u-radio activeColor="#AE38D7" label="男" name="1" @change="groupChange(1)"></u-radio>
						<u-radio activeColor="#AE38D7" label="女" name="2" @change="groupChange(2)"></u-radio>
					</u-radio-group>
				</view>
			</view>

		</view>

		<view class="card">
			<view class="title">紧急联系人<text class="title-desc">严格保密，请放心填写</text></view>
			<view class="item">
				<view class="left"><text class="required">*</text>真实姓名</view>
				<view class="right">
					<input placeholder="请输入真实姓名" v-model="contactsName" />
				</view>
			</view>
			<view class="item" @click="show = true">
				<view class="left"><text class="required">*</text>Ta是您的</view>
				<view class="right">
					<view class="xuanze">
						<view class="text">{{contacts_relation_text}}</view>
						<image src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view>
			<u-picker :show="show" :columns="contacts_relations" keyName="data_value" @cancel="show=false"
				@confirm="changeRelation"></u-picker>
			<view class="item">
				<view class="left"><text class="required">*</text>联系电话</view>
				<view class="right">
					<input placeholder="请输入联系电话" v-model="contacts_mobile" />
				</view>
			</view>

		</view>

		<view class="card">
			<view class="title">其他信息<text class="title-desc">帮助咨询师了解你并评估你们是否匹配</text></view>
			<view class="item">
				<view class="left">咨询目标：</view>
			</view>
			<view class="item2">
				<u--textarea v-model="service_target" placeholder="请输入咨询目标"></u--textarea>
			</view>

			<view class="item">
				<view class="left">现居城市</view>
				<view class="right">
					<input placeholder="请输入现居城市" v-model="live_city" />
				</view>
			</view>
			<view class="item">
				<view class="left">职业</view>
				<view class="right">
					<input placeholder="请输职业" v-model="job" />
				</view>
			</view>
			<view class="item">
				<view class="left">情感状态</view>
				<view class="right">
					<input placeholder="请输情感状态" v-model="emotion" />
				</view>
			</view>

			<!-- <view class="item" @click="show = true">
				<view class="left">情感状态</view>
				<view class="right">
					<view class="xuanze">
						<view class="text">请选择</view>
						<image src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view> -->
			<!-- <u-picker :show="show" :columns="columns" @change="show=false"></u-picker> -->

			<view class="item">
				<view class="left">有无子女</view>
				<view class="right">
					<u-radio-group v-model="has_children" placement="row">
						<u-radio activeColor="#AE38D7" label="有" name="1" @change="groupchildren(1)"></u-radio>
						<u-radio activeColor="#AE38D7" label="无" name="2" @change="groupchildren(2)"></u-radio>
					</u-radio-group>
				</view>
			</view>

			<view class="item1">
				<view class="sub-title"><text class="required">*</text>是否有精神科服药史或者就医史</view>
				<view class="s-g">
					<u-radio-group v-model="isTakeMedicine" placement="column">
						<u-radio shape="circle" activeColor="#AE38D7" label="是(请填写或上传精神科诊断资料或者就医史信息)" name="1"
							@change="changetake(1)"></u-radio>
						<view class="item2">
							<u-upload :fileList="fileList1" @afterRead="afterRead" @delete="deletePic" name="1" multiple
								:maxCount="10"></u-upload>
						</view>
						<u-radio shape="circle" activeColor="#AE38D7" label="否" name="2"
							@change="changetake(0)"></u-radio>
					</u-radio-group>
				</view>
			</view>

			<view class="item">
				<view class="left">是否是圆融学员</view>
				<view class="right">
					<u-radio-group v-model="isVip" placement="row">
						<u-radio activeColor="#AE38D7" label="是" name="1" @change="changeIsVip(1)"></u-radio>
						<u-radio activeColor="#AE38D7" label="否" name="0" @change="changeIsVip(0)"></u-radio>
					</u-radio-group>
				</view>
			</view>

			<view class="item">
				<view class="left">是否正在一段心理咨询中</view>
				<view class="right">
					<u-radio-group v-model="isConsult" placement="row">
						<u-radio activeColor="#AE38D7" label="是" name="1" @change="changeisConsult(1)"></u-radio>
						<u-radio activeColor="#AE38D7" label="否" name="0" @change="changeisConsult(0)"></u-radio>
					</u-radio-group>
				</view>
			</view>
		</view>


		<teleport v-if="gouxuan===false">
			<view class="xieyi">
				<image class="icon" src="../../static/img/gouxuan.png" @click="gouxuanc(true)"></image>
				<view class="tiaoyue">我同意并签署<text style="color:#242424"
						@click="navPage('/pagesA/doc/xieyi?id=12')">《软件使用协议》</text></view>
			</view>
		</teleport>
		<teleport v-if="gouxuan">
			<view class="xieyi">
				<image class="icon" src="../../static/img/xuanzhong.png" @click="gouxuanc(false)"></image>
				<view class="tiaoyue">我同意并签署<text style="color:#242424"
						@click="navPage('/pagesA/doc/xieyi?id=12')">《软件使用协议》</text></view>
			</view>
		</teleport>

		<view style="height: 150rpx;"></view>
		<view class="btn" @click="submit">确认新增</view>

	</view>
</template>

<script>
	import {
		uploadFile,
		addVisitingSurvey,
		getDataDictionaryList,
		getVisitingSurveyDetails
	} from '../../config/api';
	export default {
		data() {
			return {
				gouxuan: false,
				show: false,
				residentName: '',
				residentSex: '',
				residentAge: '',
				contactsName: '',
				contacts_relation: '',
				contacts_mobile: '',
				service_target: '',
				live_city: '',
				isVip: '',
				isConsult: '',
				emotion: '',
				has_children: '',
				fileList1: [],
				contacts_relations: [],
				contacts_relation_text: '请选择',
				medicine_pic: [],
				isTakeMedicine: '',
				visit_id:''
			};
		},

		async onLoad(options) {

			let contactsRelation = await getDataDictionaryList({
				data_code: 'visiting_survey_relation_code'
			})

			this.contacts_relations.push(contactsRelation)
			this.visit_id = options.visit_id

			if (options.visit_id) {
				getVisitingSurveyDetails({
					visiting_survey_id: this.visit_id
				}).then((data) => {
					this.residentName = data.resident_name
					this.residentSex = data.resident_sex
					this.residentAge = data.resident_age
					this.contactsName = data.contacts_name
					this.contacts_relation = data.contacts_relation
					this.contacts_mobile = data.contacts_mobile
					this.service_target = data.service_target
					this.live_city = data.live_city
					this.isVip = data.is_vip
					this.isConsult = data.is_counseling

					this.gouxuan = true
				})
			}

		},
		methods: {
			navPage(url) {
				uni.navigateTo({
					url
				})
			},
			submit() {
				if (!this.gouxuan) {
					uni.showToast({
						icon: 'none',
						title: '请先确认协议'
					})
					return false
				}
				let medicine_pic = []

				this.fileList1.forEach(item => {
					medicine_pic.push(item.url)
				})

				const params = {
					residentName: this.residentName,
					residentAge: this.residentAge,
					residentSex: this.residentSex,
					contactsName: this.contactsName,
					contactsName: this.contactsName,
					contacts_relation: this.contacts_relation,
					contacts_mobile: this.contacts_mobile,
					service_target: this.service_target,
					live_city: this.live_city,
					job: this.job,
					emotion: this.emotion,
					has_children: this.has_children,
					isTakeMedicine: this.isTakeMedicine,
					isVip: this.isVip,
					isConsult: this.isConsult,
					medicine_pic: medicine_pic.join(','),
				}

				addVisitingSurvey(params).then((data) => {
					if (typeof data == 'object') {
						uni.showToast({
							icon: 'none',
							title: data.msg
						})
					} else {
						uni.$emit('laifang', {
							'id': data
						})
						uni.navigateBack()
					}
				})
			},

			gouxuanc(bol) {
				this.gouxuan = bol
			},
			changeRelation(e) {
				this.contacts_relation_text = e.value[0].data_value
				this.contacts_relation = e.value[0].data_key
				this.show = false
			},
			groupChange(e) {
				this.residentSex = e
			},
			changetake(e) {
				this.isTakeMedicine = e
			},
			changeIsVip(e) {
				this.isVip = e
			},
			changeisConsult(e) {
				this.isConsult = e
			},

			groupchildren(e) {
				this.has_children = e
			},

			deletePic(event) {
				this[`fileList${event.name}`].splice(event.index, 1);
			},

			// 读取图片并上传
			async afterRead(event) {
				let lists = [].concat(event.file);
				let fileListName = `fileList${event.name}`;
				let fileListLen = this[fileListName].length;

				// 显示上传中状态
				lists.map((item) => {
					this[fileListName].push({
						...item,
						status: 'uploading',
						message: '上传中'
					});
				});

				// 上传每个文件
				for (let i = 0; i < lists.length; i++) {
					const result = await this.uploadFilePromise(lists[i].url);
					let item = this[fileListName][fileListLen];
					this[fileListName].splice(fileListLen, 1, {
						...item,
						status: 'success',
						message: '',
						url: result // 上传成功后的URL
					});
					fileListLen++;
				}
			},

			// 调用上传文件接口
			async uploadFilePromise(url) {
				let response = await uploadFile({
					filePath: url,
					name: 'file[]'
				});

				return response.url;
			}
		}

	}
</script>

<style lang="scss" scoped>
	.required {
		color: red;
	}

	.s-g {
		margin-top: 30rpx;
	}

	.title-desc {
		font-weight: 400;
		font-size: 24rpx;
		color: #999999;
		margin-left: 30rpx;
	}

	.main {
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;

		.card {
			background-color: white;
			padding: 30rpx;
			box-sizing: border-box;
			border-radius: 16rpx;
			margin-bottom: 30rpx;

			.title {
				font-weight: bold;
				font-size: 32rpx;
				color: #242424;
			}

			.item {
				height: 88rpx;
				display: flex;
				justify-content: space-between;
				border-bottom: 1px solid #F6F6F6;
				align-items: center;

				.left {
					font-weight: 400;
					font-size: 28rpx;
					color: #242424;
				}

				.right {
					input {
						text-align: right;
						font-size: 28rpx;
						color: #999999;
					}

					.xuanze {
						display: flex;
						align-items: center;

						.text {
							font-weight: 400;
							font-size: 28rpx;
							color: #999999;
						}

						image {
							width: 30rpx;
							height: 30rpx;
						}
					}

				}



			}

			.item1 {
				.miaoshu {
					font-weight: 400;
					font-size: 24rpx;
					color: #666666;
				}
			}

			.item2 {
				margin-top: 20rpx;
			}
		}

	}


	.xieyi {
		display: flex;
		align-items: center;

		.tiaoyue {
			font-weight: 400;
			font-size: 28rpx;
			color: #999999;
			margin-left: 30rpx;
		}

		.icon {
			width: 30rpx;
			height: 30rpx;
			border-radius: 50%;
		}
	}

	.btn {
		position: fixed;
		bottom: 50rpx;
		width: 690rpx;
		height: 88rpx;
		background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;
		font-weight: bold;
		font-size: 28rpx;
		color: #FFFFFF;
		line-height: 88rpx;
		text-align: center;
	}
</style>