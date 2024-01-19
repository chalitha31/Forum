function pageTravel(location) {
    window.location.href = location;
}

function listNumbering(input) {
    let reportNum = Array.from(document.querySelectorAll(`.${input}`));
    let num = 1;
    for (let item of reportNum) {
        item.textContent = `${num}.`;
        num++;
    }
}

listNumbering('report-number');
listNumbering('member-number');
listNumbering('post-number');
listNumbering('moderator-number');