function setKanbanInfo(element) {
    console.log(element.getAttribute('value'));
    document.getElementById('kanban_id').value = element.getAttribute('value');
}
