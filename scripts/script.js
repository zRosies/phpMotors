const update = document.querySelector("#update");
const newLastMod= document.lastModified;
const modified= new Date(newLastMod);

// const lastMod= modified.toLocaleString('en-Us');
const options= {
    year: "numeric",
    month:"long",
    day:"numeric"
}

const formdate= new Intl.DateTimeFormat("en-US", options).format(
	modified
);

update.textContent=formdate;


