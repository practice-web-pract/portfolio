(function () {
    const form = document.getElementsByClassName('popup__form')[0];
    let isButtonDisabled = false;

    const resetForm = () => {
        isButtonDisabled = false;
        document.getElementById('saving-indicator').innerHTML = '';
    }

    const setPendingStatus = () => {
        isButtonDisabled = true;
        document.getElementById('saving-indicator').innerHTML = '<div style="text-align: center; margin-top: 20px;"><b>please wait...</b></div>';
    }

    const saveData = ({ name, email }) => {
        if (isButtonDisabled) {
            return;
        }

        setPendingStatus();

        fetch('https://script.google.com/macros/s/AKfycbyTtmMCUNHdXQcwhTrWK0cY7E2JHEzziVsrvcKsAgaXojWwoLYGSFttpTSXodndYg59yA/exec', {
            method : 'post',
            body: JSON.stringify({
                time: new Date(),
                name,
                email
            })
        })
            .then((res) => res.json())
            .then(() => {
                window.location.hash = '#';
                iziToast.show({
                    color: 'green',
                    title: 'Cool!',
                    message: 'Your data has been saved successfully'
                });
                resetForm();
            })
            .catch((error) => {
                window.location.hash = '#';
                iziToast.show({
                    color: 'red',
                    title: 'Oops!',
                    message: 'Something went wrong, try again later.'
                });
                resetForm();
            });
    }

    const handleForm = (event) => {
        const name = document.getElementById('pre-registration-name').value;
        const email = document.getElementById('pre-registration-email').value;

        event.preventDefault();
        saveData({ name, email });
    }

    form.addEventListener('submit', handleForm);
})()
