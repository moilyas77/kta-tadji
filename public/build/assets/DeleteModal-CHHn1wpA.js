import{C as d,o as p,c as f,w as a,d as o,a as e,t as c,b}from"./app-Bmo5HFoe.js";import{u as g,_ as x}from"./pagination-BhSgCxto.js";const y={class:"mt-6"},k={class:"flex justify-end mt-4"},v={class:"flex gap-2 w-1/2"},B={__name:"DeleteModal",props:{user:{type:Object,required:!0}},emits:["close"],setup(n,{emit:u}){const s=u,i=d({}),r=g(),l=()=>{i.delete(route("users.destroy",{user:n.user.id,page:r.getCurrentPage,search:r.getSearchKey}),{onSuccess:()=>{s("close")},preserveScroll:!0})};return(S,t)=>(p(),f(x,{onClose:t[1]||(t[1]=m=>s("close"))},{title:a(()=>t[2]||(t[2]=[o("Hapus Data")])),default:a(()=>[e("div",y,[e("p",null,[t[3]||(t[3]=o("Apakah kamu yakin akan menghapus ")),e("strong",null,c(n.user.nama),1),t[4]||(t[4]=o(" ?"))]),e("form",{onSubmit:b(l,["prevent"])},[e("div",k,[e("div",v,[e("button",{autofocus:"",type:"button",onClick:t[0]||(t[0]=m=>s("close")),class:"flex-1 btn btn-neutral"},"Cancel"),t[5]||(t[5]=e("button",{type:"submit",class:"flex-1 btn btn-error"},"Yes",-1))])])],32)])]),_:1}))}};export{B as default};
