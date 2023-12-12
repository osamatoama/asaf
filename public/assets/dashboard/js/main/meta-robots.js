function setMetaRobotsValue(indexInpId = 'meta_robots_index', followInpId = 'meta_robots_follow', hiddenInpId = 'meta_robots') {
    const indexInp = document.getElementById(indexInpId);
    const followInp = document.getElementById(followInpId);
    const metaRobotsValue = document.getElementById(hiddenInpId).value;
    if (metaRobotsValue) {
        const metaRobotsValues = metaRobotsValue.split('-');
        metaRobotsValues.forEach((value) => {
            switch (value) {
                case 'index':
                    indexInp.checked = true;
                    break;
                case 'noindex':
                    indexInp.checked = false;
                    break;
                case 'follow':
                    followInp.checked = true;
                    break;
                case 'nofollow':
                    followInp.checked = false;
                    break;
            }
        });
    }
}

function switchMetaRobotsHandler(indexInpId = 'meta_robots_index', followInpId = 'meta_robots_follow', hiddenInpId = 'meta_robots') {
    const indexInpValue = document.getElementById(indexInpId).checked ? 'index' : 'noindex';
    const followInpValue = document.getElementById(followInpId).checked ? 'follow' : 'nofollow';
    document.getElementById(hiddenInpId).value = `${indexInpValue}-${followInpValue}`;
}
