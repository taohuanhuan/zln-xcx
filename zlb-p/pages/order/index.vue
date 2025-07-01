<template>
  <view class="order-page">
    <u-tabs :list="tabList" :current="current" line-color="#1FCF76" active-color="#1FCF76" inactive-color="#606266" line-height="4" line-width="60" @click="changeTab" />
    <scroll-view class="list" scroll-y refresher-enabled :refresher-triggered="refreshing" @refresherrefresh="onRefresh" @scrolltolower="onLoadMore">
      <view v-for="(item,index) in orders" :key="index" class="card" @click="goDetail(item)">
        <view class="card-header">
          <text class="no">订单编号：{{ item.orderNo }}</text>
          <text class="status" :class="item.status">{{ statusText(item.status) }}</text>
        </view>
        <view class="card-content">
          <image :src="item.cover" class="cover" mode="aspectFill" />
          <view class="info">
            <view class="name">{{ item.gym }}</view>
            <view class="mode">{{ item.mode }}</view>
            <view class="price"><text>实付款</text><text class="amount">{{ item.amount }}</text></view>
          </view>
        </view>
        <view class="card-footer">
          <u-button v-if="item.canRate" type="primary" plain shape="circle" size="mini" @click.stop="openRate(item)">评价</u-button>
        </view>
      </view>
      <u-empty v-if="!orders.length && loadStatus!=='loading'" text="暂无数据" mode="list" />
      <u-loadmore :status="loadStatus" />
    </scroll-view>
    <OrderRate ref="rate" @submit="submitRate" />
  </view>
</template>

<script>
import OrderRate from '@/components/OrderRate.vue'
export default {
  components: { OrderRate },
  data() {
    return {
      tabList: [
        { name: '全部', value: 'all' },
        { name: '待使用', value: 'unused' },
        { name: '已完成', value: 'done' },
        { name: '已退款', value: 'refund' }
      ],
      current: 0,
      status: 'all',
      orders: [],
      page: 1,
      pageSize: 10,
      loadStatus: 'loadmore',
      refreshing: false
    }
  },
  onLoad() {
    this.fetchList(true)
  },
  methods: {
    statusText(s){
      const map={unused:'待使用',done:'已完成',refund:'已退款'}
      return map[s]||'全部'
    },
    changeTab(index){
      this.current=index
      this.status=this.tabList[index].value
      this.fetchList(true)
    },
    onRefresh(){
      this.refreshing=true
      this.fetchList(true)
    },
    onLoadMore(){
      this.fetchList()
    },
    fetchList(reset=false){
      if(reset){
        this.page=1
        this.orders=[]
      }
      this.loadStatus='loading'
      setTimeout(()=>{
        const list=Array.from({length:this.pageSize},(_,i)=>{
          const idx=(this.page-1)*this.pageSize+i+1
          return {
            orderNo: '20250'+idx,
            status: this.status==='all' ? ['unused','done','refund'][i%3] : this.status,
            cover: 'https://via.placeholder.com/120',
            gym: '示例场馆'+idx,
            mode: '在线预定',
            amount: '￥99.00',
            canRate: this.status==='done'
          }
        })
        this.orders=this.orders.concat(list)
        this.page++
        this.loadStatus=this.page>2?'nomore':'loadmore'
        this.refreshing=false
      },500)
    },
    goDetail(item){
      uni.navigateTo({url:'/pages/order/detail'})
    },
    openRate(item){
      this.$refs.rate.open(item.orderNo)
    },
    submitRate(data){
      // TODO: submit rating
    }
  }
}
</script>

<style scoped>
.order-page{
  background:#F5F5F5;
  min-height:100vh;
  padding:24rpx;
}
.list{
  height:calc(100vh - 80rpx);
  margin-top:20rpx;
}
.card{
  background:#FFFFFF;
  border-radius:8px;
  box-shadow:0 2rpx 8rpx rgba(0,0,0,0.05);
  padding:24rpx;
  margin-bottom:20rpx;
}
.card-header{
  display:flex;
  justify-content:space-between;
  font-size:22rpx;
  color:#909399;
}
.status.unused{color:#FF5722;}
.status.done{color:#909399;}
.status.refund{color:#909399;}
.card-content{
  display:flex;
  margin-top:20rpx;
}
.cover{
  width:120rpx;
  height:120rpx;
  border-radius:8px;
  margin-right:20rpx;
}
.info{flex:1;position:relative;}
.name{
  font-size:28rpx;
  font-weight:600;
  color:#202020;
  line-height:36rpx;
}
.mode{
  font-size:22rpx;
  color:#606266;
  margin-top:4rpx;
}
.price{
  position:absolute;
  right:0;
  bottom:0;
  font-size:22rpx;
  color:#202020;
}
.amount{
  font-weight:600;
  font-size:26rpx;
  margin-left:8rpx;
}
.card-footer{
  display:flex;
  justify-content:flex-end;
  margin-top:20rpx;
}
</style>
