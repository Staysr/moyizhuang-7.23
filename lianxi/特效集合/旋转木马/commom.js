
function $id(id) {
    return document.getElementById(id);
}

/**
 * ��ȡԪ�ؼ��������ʽ�ļ���д��
 * @param element   Ŀ��Ԫ��
 * @param attr  ��Ҫ��ȡ������
 * @returns {*} ��Ӧ���Եĵ�ǰֵ
 */
function getStyle(element,attr) {
    return element.currentStyle ? element.currentStyle[attr] : window.getComputedStyle(element,null)[attr];
}