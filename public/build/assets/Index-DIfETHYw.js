import{C as h,r as x,l as g,o,c as b,w as i,a as e,b as v,h as w,v as y,e as u,t as r,g as S,u as d,d as c,f as k,P as N}from"./app-Bmo5HFoe.js";import{_}from"./UserLayout-h4zwnPVc.js";import{u as B}from"./pagination-BhSgCxto.js";import"./BaseLayout-BoV4VSrS.js";import"./LogoutModal-BtPpPKvC.js";const M={class:"py-20 px-10 flex flex-col gap-10 items-center"},V={class:"flex w-72 gap-1"},A={class:"w-full"},C={key:0,class:"table table-zebra w-full"},K={class:"text-center"},D={class:"text-center"},E={class:"flex justify-center gap-2"},P={class:"tooltip min-h-6 flex items-center","data-tip":"Lihat Detail"},j={key:1,class:"text-center"},L={class:"font-semibold underline"},O={__name:"Index",props:{user:Object},setup(a){const l=B(),f=h({}),s=x(""),m=()=>{const n=s.value==""?route("user.search-user.index"):route("user.search-user.index",{search:s.value});f.get(n,{onSuccess:()=>{l.setSearchKey(s.value)},onError:()=>{},preserveScroll:!0})};return g(()=>{s.value=l.getSearchKey}),(n,t)=>(o(),b(_,null,{default:i(()=>[e("div",M,[t[6]||(t[6]=e("span",{class:"text-2xl font-semibold pb-2 px-10 border-b border-base-content/50"}," Silahkan Masukan No Anggota ",-1)),e("form",{onSubmit:v(m,["prevent"])},[e("div",V,[w(e("input",{"onUpdate:modelValue":t[0]||(t[0]=p=>s.value=p),type:"text",class:"flex-grow input input-md input-bordered",placeholder:"No. Anggota",maxlength:"14"},null,512),[[y,s.value]]),t[1]||(t[1]=e("button",{type:"submit",class:"btn btn-md input-bordered h-full"},[e("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 16 16",fill:"currentColor",class:"h-4 w-4 opacity-70"},[e("path",{"fill-rule":"evenodd",d:"M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z","clip-rule":"evenodd"})])],-1))])],32),e("div",A,[a.user?(o(),u("table",C,[t[3]||(t[3]=e("thead",null,[e("tr",null,[e("th",{class:"text-center"},"No. Anggota"),e("th",null,"Nama"),e("th",{class:"text-center"},"Lihat detail")])],-1)),e("tbody",null,[e("tr",null,[e("td",K,r(a.user.no_anggota),1),e("td",null,r(a.user.nama),1),e("td",D,[e("div",E,[e("div",P,[S(d(N),{class:"btn btn-xs btn-circle btn-info font-normal",href:n.route("user.search-user.show",a.user.id)},{default:i(()=>t[2]||(t[2]=[e("i",{class:"ri-eye-line"},null,-1)])),_:1},8,["href"])])])])])])])):!a.user&&d(l).getSearchKey!=""?(o(),u("div",j,[t[4]||(t[4]=c(" Hasil pencarian dengan No. Anggota ")),e("span",L,r(s.value),1),t[5]||(t[5]=c(" tidak ditemukan "))])):k("",!0)])])]),_:1}))}};export{O as default};
